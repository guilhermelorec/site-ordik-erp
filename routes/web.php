<?php

use App\Http\Controllers\LeadController;
use App\Support\Blog;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/funcionalidades', 'pages.features')->name('features');
Route::view('/pdv', 'pages.pdv')->name('pdv');
Route::view('/implantacao', 'pages.implantation')->name('implantation');
Route::view('/empresa', 'pages.about')->name('about');
Route::view('/contato', 'pages.contact')->name('contact');

Route::get('/para/{slug}', fn (string $slug) => view('pages.solution', [
    'slug' => $slug,
    'solution' => config("ordik.solutions.$slug") ?? abort(404),
]))->name('solutions.show');

Route::get('/blog', fn () => view('pages.blog.index', ['posts' => Blog::all()]))->name('blog.index');
Route::get('/blog/{slug}', fn (string $slug) => view('pages.blog.show', [
    'post' => Blog::find($slug) ?? abort(404),
]))->name('blog.show');

Route::post('/contato', [LeadController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::get('/sitemap.xml', fn () => response()
    ->view('sitemap', ['urls' => [
        ...array_map(route(...), ['home', 'features', 'pdv', 'implantation', 'about', 'contact', 'blog.index']),
        ...array_map(fn (string $slug) => route('solutions.show', $slug), array_keys(config('ordik.solutions'))),
        ...Blog::all()->map(fn (object $post) => route('blog.show', $post->slug)),
    ]])
    ->header('Content-Type', 'application/xml'))->name('sitemap');

Route::get('/robots.txt', fn () => response(implode("\n", [
    'User-agent: *',
    app()->isProduction() ? 'Disallow: /admin' : 'Disallow: /',
    '',
    'Sitemap: '.route('sitemap'),
])."\n")->header('Content-Type', 'text/plain'));
