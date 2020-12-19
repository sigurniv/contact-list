<?php

use Illuminate\Support\Facades\Route;

Route::post('/contacts', [\App\Http\Controllers\Contact\ContactController::class, 'create'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('contacts.create');

Route::post('/contacts/delete', [\App\Http\Controllers\Contact\ContactController::class, 'delete'])
    ->middleware(['auth'])
    ->name('contacts.delete');

Route::get('/contacts/{id}', [\App\Http\Controllers\Contact\ContactController::class, 'show'])
    ->middleware(['auth'])
    ->name('contacts.show');

Route::post('/contacts/{id}', [\App\Http\Controllers\Contact\ContactController::class, 'update'])
    ->middleware(['auth'])
    ->name('contacts.update');
