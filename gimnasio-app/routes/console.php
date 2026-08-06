<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('check:db', function () {
    try {
        $connection = app('db')->connection();
        $connection->getPdo();
        $this->info('DB connection OK');
        $this->info('Current connection: ' . $connection->getName());
    } catch (Throwable $e) {
        $this->error('DB connection failed: ' . $e->getMessage());
    }
})->purpose('Check database connectivity');
