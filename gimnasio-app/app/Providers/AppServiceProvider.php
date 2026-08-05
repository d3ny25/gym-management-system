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
            $requestHost = $this->app['request']->getSchemeAndHttpHost();
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
            $this->app['config']->set('database.connections.mysql.url', env('DB_URL', env('DATABASE_URL')));
        }
    }
}
