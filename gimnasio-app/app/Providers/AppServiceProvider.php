<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDatabaseConnection();

        if ($this->app->environment('production') || env('FORCE_HTTPS', false)) {
            try {
                $requestHost = $this->app['request']->getSchemeAndHttpHost();
            } catch (\Throwable $e) {
                $requestHost = env('APP_URL', 'https://' . $this->app['request']->getHost());
            }

            $appUrl = env('APP_URL');
            $shouldUseRequestHost = empty($appUrl)
                || in_array(strtolower(trim($appUrl)), ['http://localhost', 'https://localhost', 'localhost', 'http://127.0.0.1', 'https://127.0.0.1'], true);

            URL::forceRootUrl($shouldUseRequestHost ? $requestHost : $appUrl);
            URL::forceScheme('https');

            $trustedHeaders = defined(SymfonyRequest::class.'::HEADER_X_FORWARDED_ALL')
                ? SymfonyRequest::HEADER_X_FORWARDED_ALL
                : (
                    SymfonyRequest::HEADER_X_FORWARDED_FOR |
                    SymfonyRequest::HEADER_X_FORWARDED_HOST |
                    SymfonyRequest::HEADER_X_FORWARDED_PROTO |
                    SymfonyRequest::HEADER_X_FORWARDED_PORT |
                    SymfonyRequest::HEADER_X_FORWARDED_PREFIX
                );

            SymfonyRequest::setTrustedProxies(
                ['0.0.0.0/0', '::/0'],
                $trustedHeaders
            );
        }
    }

    protected function configureDatabaseConnection(): void
    {
        $configuredConnection = env('DB_CONNECTION');
        $databaseUrl = env('DATABASE_URL');
        $dbHost = env('DB_HOST');
        $mysqlHost = env('MYSQLHOST');

        $hasExternalDatabase = !empty($databaseUrl) || !empty($dbHost) || !empty($mysqlHost);

        $defaultConnection = 'sqlite';

        if ($hasExternalDatabase) {
            $defaultConnection = !empty($configuredConnection) && $configuredConnection !== 'sqlite'
                ? $configuredConnection
                : 'mysql';
        } elseif (!empty($configuredConnection) && $configuredConnection !== 'sqlite') {
            $defaultConnection = $configuredConnection;
        }

        if (($defaultConnection === 'mysql' || $defaultConnection === 'mariadb') && !$this->app->environment('production') && !$this->canReachMysqlHost(env('DB_HOST', env('MYSQLHOST', '127.0.0.1')), env('DB_PORT', env('MYSQLPORT', '3306')))) {
            $defaultConnection = 'sqlite';
        }

        $this->app['config']->set('database.default', $defaultConnection);

        if ($defaultConnection === 'mysql' || $defaultConnection === 'mariadb') {
            $this->app['config']->set('database.connections.mysql.host', env('DB_HOST', env('MYSQLHOST', '127.0.0.1')));
            $this->app['config']->set('database.connections.mysql.port', env('DB_PORT', env('MYSQLPORT', '3306')));
            $this->app['config']->set('database.connections.mysql.database', (function () {
                $database = env('DB_DATABASE');
                $mysqlDatabase = env('MYSQLDATABASE');

                if (!empty($database) && $database !== ':memory:' && $database !== 'database.sqlite') {
                    return $database;
                }

                return !empty($mysqlDatabase) ? $mysqlDatabase : 'laravel';
            })());
            $this->app['config']->set('database.connections.mysql.username', env('DB_USERNAME', env('MYSQLUSER', 'root')));
            $this->app['config']->set('database.connections.mysql.password', env('DB_PASSWORD', env('MYSQLPASSWORD', '')));

            $databaseUrl = env('DATABASE_URL');
            $mysqlHost = env('MYSQLHOST');

            if (empty($mysqlHost) && !empty($databaseUrl)) {
                $this->app['config']->set('database.connections.mysql.url', $databaseUrl);
            }
        }
    }

    protected function canReachMysqlHost(string $host, string $port): bool
    {
        $host = trim($host);

        if ($host === '' || $host === '127.0.0.1' || $host === 'localhost' || $host === '::1' || $host === '0.0.0.0') {
            return true;
        }

        $resolvedHost = @gethostbyname($host);

        if ($resolvedHost === false || $resolvedHost === $host) {
            return false;
        }

        $socket = @fsockopen($resolvedHost, (int) $port, $errno, $errstr, 2);

        if ($socket === false) {
            return false;
        }

        fclose($socket);

        return true;
    }
}
