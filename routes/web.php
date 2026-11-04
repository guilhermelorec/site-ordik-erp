<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');

Route::get('/sitemap.xml', fn () => response()
    ->view('sitemap', ['urls' => [route('home')]])
    ->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/robots.txt', fn () => response(implode("\n", [
    'User-agent: *',
    app()->isProduction() ? 'Disallow: /admin' : 'Disallow: /',
    '',
    'Sitemap: '.route('sitemap'),
])."\n")->header('Content-Type', 'text/plain'));
