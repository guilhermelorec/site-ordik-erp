<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/contato', 'pages.contact')->name('contact');

Route::post('/contato', [LeadController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/sitemap.xml', fn () => response()
    ->view('sitemap', ['urls' => [route('home'), route('contact')]])
    ->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/robots.txt', fn () => response(implode("\n", [
    'User-agent: *',
    app()->isProduction() ? 'Disallow: /admin' : 'Disallow: /',
    '',
    'Sitemap: '.route('sitemap'),
])."\n")->header('Content-Type', 'text/plain'));
