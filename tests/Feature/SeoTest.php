<?php

use App\Providers\AppServiceProvider;

it('serves the sitemap with the public pages', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml')
        ->assertSee(route('home'))
        ->assertSee(route('solutions.show', 'oficinas'))
        ->assertSee(route('blog.show', 'controle-de-estoque-como-organizar'));
});

it('hides the site from crawlers outside production', function () {
    $this->get('/robots.txt')
        ->assertOk()
        ->assertSee('Disallow: /')
        ->assertSee('Sitemap: '.route('sitemap'));
});

it('allows crawlers in production except on the admin', function () {
    app()->detectEnvironment(fn () => 'production');

    $this->get('/robots.txt')
        ->assertOk()
        ->assertSee('Disallow: /admin')
        ->assertDontSee("Disallow: /\n");
});

it('renders meta tags and JSON-LD on the home page', function () {
    $this->get('/')
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('property="og:image"', false)
        ->assertSee('name="twitter:card"', false)
        ->assertSee('"@context":"https://schema.org"', false)
        ->assertSee('"@type":"Organization"', false)
        ->assertSee('"@type":"SoftwareApplication"', false);
});

it('leaves robots.txt to the route instead of a static file', function () {
    expect(public_path('robots.txt'))->not->toBeFile();
});

it('uses APP_URL in production but keeps the current host on previews', function (bool $forceRootUrl, string $expectedRoot) {
    app()->detectEnvironment(fn () => 'production');
    config(['app.url' => 'https://ordik.com.br', 'ordik.force_root_url' => $forceRootUrl]);

    (new AppServiceProvider(app()))->boot();

    expect(url('/contato'))->toStartWith($expectedRoot);
})->with([
    'production' => [true, 'https://ordik.com.br/'],
    'preview' => [false, 'https://localhost'],
]);

it('keeps the sitemap template safe when short open tags are enabled', function () {
    expect(file_get_contents(resource_path('views/sitemap.blade.php')))->not->toContain('<?xml');

    $this->get('/sitemap.xml')->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
});
