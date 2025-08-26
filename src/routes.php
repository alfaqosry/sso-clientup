<?php

use Illuminate\Support\Facades\Route;
use AlfaQosry\SsoClient\Http\Controllers\SsoCallbackController;

Route::get('/sso/callback', [SsoCallbackController::class, 'handle'])->name('sso.callback');