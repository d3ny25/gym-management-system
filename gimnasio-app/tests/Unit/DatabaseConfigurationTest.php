<?php

namespace Tests\Unit;

use App\Providers\AppServiceProvider;
use Tests\TestCase;

class DatabaseConfigurationTest extends TestCase
{
    public function test_railway_mysql_environment_variables_select_mysql_connection(): void
    {
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_HOST');
        putenv('DB_PORT');
        putenv('DB_DATABASE');
        putenv('DB_USERNAME');
        putenv('DB_PASSWORD');
        putenv('DATABASE_URL');
        putenv('MYSQLHOST=containers-us-west-1.railway.app');
        putenv('MYSQLPORT=3306');
        putenv('MYSQLDATABASE=gimnasio_db');
        putenv('MYSQLUSER=root');
        putenv('MYSQLPASSWORD=secret');
        putenv('APP_ENV=testing');

        $databaseConfig = require dirname(__DIR__, 2) . '/config/database.php';
        $this->app['config']->set('database', $databaseConfig);

        $this->assertSame('mysql', config('database.default'));
        $this->assertSame('containers-us-west-1.railway.app', config('database.connections.mysql.host'));
        $this->assertSame('3306', config('database.connections.mysql.port'));
        $this->assertSame('gimnasio_db', config('database.connections.mysql.database'));
        $this->assertSame('root', config('database.connections.mysql.username'));
        $this->assertSame('secret', config('database.connections.mysql.password'));
    }

    public function test_service_provider_overrides_cached_database_config_to_mysql(): void
    {
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_HOST');
        putenv('DB_PORT');
        putenv('DB_DATABASE');
        putenv('DB_USERNAME');
        putenv('DB_PASSWORD');
        putenv('DATABASE_URL');
        putenv('MYSQLHOST=containers-us-west-1.railway.app');
        putenv('MYSQLPORT=3306');
        putenv('MYSQLDATABASE=gimnasio_db');
        putenv('MYSQLUSER=root');
        putenv('MYSQLPASSWORD=secret');
        putenv('APP_ENV=testing');

        $this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.mysql.host', '127.0.0.1');
        $this->app['config']->set('database.connections.mysql.database', ':memory:');

        $provider = new AppServiceProvider($this->app);
        $provider->boot();

        $this->assertSame('mysql', config('database.default'));
        $this->assertSame('containers-us-west-1.railway.app', config('database.connections.mysql.host'));
        $this->assertSame('gimnasio_db', config('database.connections.mysql.database'));
    }

    public function test_service_provider_falls_back_to_sqlite_when_mysql_host_is_unreachable(): void
    {
        putenv('DB_CONNECTION=mysql');
        putenv('DB_HOST=unresolvable.invalid');
        putenv('DB_PORT=3306');
        putenv('DB_DATABASE=gym');
        putenv('DB_USERNAME=root');
        putenv('DB_PASSWORD=secret');
        putenv('DATABASE_URL');
        putenv('MYSQLHOST');
        putenv('MYSQLPORT');
        putenv('MYSQLDATABASE');
        putenv('MYSQLUSER');
        putenv('MYSQLPASSWORD');

        $this->app['config']->set('database.default', 'mysql');
        $this->app['config']->set('database.connections.mysql.host', '127.0.0.1');
        $this->app['config']->set('database.connections.mysql.database', ':memory:');

        $provider = new AppServiceProvider($this->app);
        $provider->boot();

        $this->assertSame('sqlite', config('database.default'));
    }
}
