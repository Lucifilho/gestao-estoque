<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockedProductController;

Route::get('/', [StockedProductController::class, 'index'])->name('general.index');
