<?php

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
        ->assertSee('"@type":"Organization"', false)
        ->assertSee('"@type":"SoftwareApplication"', false);
});

it('leaves robots.txt to the route instead of a static file', function () {
    expect(public_path('robots.txt'))->not->toBeFile();
});
