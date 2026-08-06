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
        //
    }

    protected function canReachMysqlHost(string $host, string $port): bool
    {
        return true;
    }
}
