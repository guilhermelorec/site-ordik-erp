<?php

it('renders every public page', function (string $url) {
    $this->get($url)->assertOk();
})->with([
    '/',
    '/contato',
    '/funcionalidades',
    '/pdv',
    '/implantacao',
    '/empresa',
    '/blog',
    '/privacidade',
    '/termos',
    '/blog/controle-de-estoque-como-organizar',
    '/para/lojas',
    '/para/oficinas',
    '/para/distribuidoras',
]);

it('returns 404 for an unknown solution', function () {
    $this->get('/para/nao-existe')->assertNotFound();
});

it('lists the FAQ as structured data on the home page', function () {
    $this->get('/')->assertSee('"@type":"FAQPage"', false);
});

it('returns 404 for unknown or unsafe blog slugs', function (string $url) {
    $this->get($url)->assertNotFound();
})->with(['/blog/post-inexistente', '/blog/..%2F..%2F.env']);

it('shows the custom 404 page', function () {
    $this->get('/nao-existe')->assertNotFound()->assertSee('Esta página não existe');
});
