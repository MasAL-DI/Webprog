<?php

use App\Http\Controllers\Api\ScanController;
use Illuminate\Support\Facades\Route;

Route::post('scan', [ScanController::class, 'store'])
    ->middleware('device.key'); // alias didaftarkan di bootstrap/app.php
