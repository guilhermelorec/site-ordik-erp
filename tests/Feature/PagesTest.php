<?php

it('renders every public page', function (string $url) {
    $this->get($url)->assertOk();
})->with([
    '/',
    '/contato',
]);
