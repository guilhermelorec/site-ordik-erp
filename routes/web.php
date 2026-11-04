<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/funcionalidades', 'pages.features')->name('features');
Route::view('/pdv', 'pages.pdv')->name('pdv');
Route::view('/implantacao', 'pages.implantation')->name('implantation');
Route::view('/contato', 'pages.contact')->name('contact');

Route::get('/para/{slug}', fn (string $slug) => view('pages.solution', [
    'slug' => $slug,
    'solution' => config("ordik.solutions.$slug") ?? abort(404),
]))->name('solutions.show');

Route::post('/contato', [LeadController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/sitemap.xml', fn () => response()
    ->view('sitemap', ['urls' => [
        ...array_map(route(...), ['home', 'features', 'pdv', 'implantation', 'contact']),
        ...array_map(fn (string $slug) => route('solutions.show', $slug), array_keys(config('ordik.solutions'))),
    ]])
    ->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/robots.txt', fn () => response(implode("\n", [
    'User-agent: *',
    app()->isProduction() ? 'Disallow: /admin' : 'Disallow: /',
    '',
    'Sitemap: '.route('sitemap'),
])."\n")->header('Content-Type', 'text/plain'));
