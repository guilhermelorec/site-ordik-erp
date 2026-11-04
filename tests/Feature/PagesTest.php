<?php

it('renders every public page', function (string $url) {
    $this->get($url)->assertOk();
})->with([
    '/',
    '/contato',
    '/funcionalidades',
    '/pdv',
    '/implantacao',
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
