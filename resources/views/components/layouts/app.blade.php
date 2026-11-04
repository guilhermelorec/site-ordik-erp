@props([
    'title' => null,
    'description' => 'ERP para pequenas e médias empresas: vendas, estoque, compras, ordens de serviço, frente de caixa, CRM e financeiro integrados. Instalado na sua empresa, funciona sem internet.',
    'image' => null,
    'type' => 'website',
])

@php
    $nav = [
        'features' => 'Funcionalidades',
        'pdv' => 'PDV',
        'implantation' => 'Implantação',
        'about' => 'Empresa',
        'blog.index' => 'Blog',
    ];
@endphp

<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo :title="$title" :description="$description" :image="$image" :type="$type" />
    <link rel="icon" href="/brand/ordik-icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/brand/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#1E1B5E">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $head ?? '' }}
</head>
<body class="flex min-h-screen flex-col bg-paper font-sans text-ink antialiased">
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-sm focus:bg-white focus:px-4 focus:py-2">Pular para o conteúdo</a>

    <header class="sticky top-0 z-40 pt-3">
        <div class="container-site">
            <div class="relative flex h-16 items-center justify-between gap-6 rounded-full bg-white pr-3 pl-5 shadow-float">
                <a href="{{ route('home') }}" class="shrink-0" aria-label="Ordik, página inicial">
                    <img src="/brand/ordik-logo.svg" alt="Ordik" width="119" height="40" class="h-10 w-auto">
                </a>

                <nav class="hidden items-center gap-7 lg:flex" aria-label="Principal">
                    <div class="group relative">
                        <a href="{{ route('home') }}#para-quem" class="flex items-center gap-1 text-sm font-medium hover:text-indigo-600">
                            Para quem é
                            <x-heroicon-m-chevron-down class="size-4" />
                        </a>
                        <div class="invisible absolute -left-5 top-full w-80 pt-5 opacity-0 transition group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100">
                            <div class="rounded-md bg-white p-2 shadow-sheet">
                                @foreach (config('ordik.solutions') as $slug => $solution)
                                    <a href="{{ route('solutions.show', $slug) }}" class="block rounded-sm px-3 py-2.5 hover:bg-indigo-50">
                                        <span class="block text-sm font-semibold">{{ $solution['name'] }}</span>
                                        <span class="block text-sm text-muted">{{ $solution['short'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @foreach ($nav as $route => $label)
                        <a href="{{ route($route) }}" @class([
                            'text-sm font-medium hover:text-indigo-600',
                            'text-indigo-600' => request()->routeIs(Str::before($route, '.').'*'),
                        ])>{{ $label }}</a>
                    @endforeach
                </nav>

                <a href="{{ route('contact') }}" class="btn-tag hidden py-2.5 lg:inline-flex">Pedir demonstração</a>

                <details class="group lg:hidden">
                    <summary class="flex cursor-pointer list-none items-center rounded-full p-2 hover:bg-indigo-50 [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">
                        <x-heroicon-o-bars-3 class="size-7 group-open:hidden" />
                        <x-heroicon-o-x-mark class="hidden size-7 group-open:block" />
                    </summary>
                    <div class="absolute inset-x-0 top-full mt-2 rounded-lg bg-white p-5 shadow-sheet">
                        @foreach (config('ordik.solutions') as $slug => $solution)
                            <a href="{{ route('solutions.show', $slug) }}" class="block py-2 font-medium">{{ $solution['name'] }}</a>
                        @endforeach
                        @foreach ($nav as $route => $label)
                            <a href="{{ route($route) }}" class="block py-2 font-medium">{{ $label }}</a>
                        @endforeach
                        <a href="{{ route('contact') }}" class="btn-tag mt-3 w-full">Pedir demonstração</a>
                    </div>
                </details>
            </div>
        </div>
    </header>

    <main id="conteudo" class="flex-1">
        {{ $slot }}
    </main>

    <footer class="mt-16 bg-white">
        <div class="container-site grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-12">
            <div class="sm:col-span-2 lg:col-span-4">
                <img src="/brand/ordik-logo.svg" alt="Ordik" width="119" height="40" loading="lazy" class="h-10 w-auto">
                <p class="mt-4 max-w-xs text-sm text-muted">ERP para pequenas e médias empresas. Vendas, estoque, compras, ordens de serviço, frente de caixa, CRM e financeiro no mesmo sistema.</p>
                <a href="mailto:{{ config('ordik.contact_email') }}" class="link-underline mt-4 inline-block text-sm">{{ config('ordik.contact_email') }}</a>
            </div>
            @foreach ([
                'Produto' => [
                    [route('features'), 'Funcionalidades'],
                    [route('pdv'), 'Frente de caixa'],
                    [route('implantation'), 'Implantação'],
                ],
                'Para quem é' => collect(config('ordik.solutions'))->map(fn (array $solution, string $slug) => [route('solutions.show', $slug), $solution['name']])->values()->all(),
                'Ordik' => [
                    [route('about'), 'Empresa'],
                    [route('blog.index'), 'Blog'],
                    [route('contact'), 'Pedir demonstração'],
                    [route('privacy'), 'Privacidade'],
                    [route('terms'), 'Termos de uso'],
                ],
            ] as $heading => $links)
                <nav class="lg:col-span-2 last:lg:col-span-2 first-of-type:lg:col-start-6" aria-label="{{ $heading }}">
                    <h2 class="font-semibold">{{ $heading }}</h2>
                    <ul class="mt-3 space-y-2 text-sm text-muted">
                        @foreach ($links as [$url, $label])
                            <li><a href="{{ $url }}" class="hover:text-indigo-600">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>
        <div class="border-t border-line">
            <p class="container-site py-5 text-xs text-muted">&copy; {{ date('Y') }} Ordik. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
