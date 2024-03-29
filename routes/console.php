<?php

declare(strict_types = 1);

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

$inspireClosure = Closure::bind(function () {
    $this->comment(Inspiring::quote());
}, new Command());

Artisan::command('inspire', $inspireClosure)
    ->purpose('Display an inspiring quote');
