<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenDeServicioController;

Route::redirect('/', '/ordenes');

Route::resource('ordenes', OrdenDeServicioController::class)
    ->parameters(['ordenes' => 'orden'])
    ->except(['show', 'destroy']);