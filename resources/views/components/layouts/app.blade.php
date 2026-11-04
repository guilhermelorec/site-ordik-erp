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
    $navExisting = array_filter($nav, fn (string $route) => Route::has($route), ARRAY_FILTER_USE_KEY);
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

    <header class="sticky top-0 z-40 border-b border-line bg-white">
        <div class="container-site flex h-[4.25rem] items-center justify-between gap-8">
            <a href="{{ route('home') }}" class="-ml-1 shrink-0" aria-label="Ordik, página inicial">
                <img src="/brand/ordik-logo.svg" alt="Ordik" width="119" height="40" class="h-10 w-auto">
            </a>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Principal">
                @if (Route::has('solutions.show'))
                    <div class="group relative">
                        <a href="{{ route('home') }}#para-quem" class="flex items-center gap-1 text-sm font-medium hover:text-indigo-600">
                            Para quem é
                            <x-heroicon-m-chevron-down class="size-4" />
                        </a>
                        <div class="invisible absolute -left-4 top-full w-72 pt-3 opacity-0 transition group-focus-within:visible group-focus-within:opacity-100 group-hover:visible group-hover:opacity-100">
                            <div class="rounded-md border border-line bg-white p-2 shadow-sheet">
                                @foreach (config('ordik.solutions', []) as $slug => $solution)
                                    <a href="{{ route('solutions.show', $slug) }}" class="block rounded-sm px-3 py-2 hover:bg-paper">
                                        <span class="block text-sm font-medium">{{ $solution['name'] }}</span>
                                        <span class="block text-xs text-muted">{{ $solution['short'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @foreach ($navExisting as $route => $label)
                    <a href="{{ route($route) }}" @class([
                        'text-sm font-medium hover:text-indigo-600',
                        'text-indigo-600' => request()->routeIs(Str::before($route, '.').'*'),
                    ])>{{ $label }}</a>
                @endforeach
            </nav>

            <div class="hidden lg:block">
                @if (Route::has('contact'))
                    <a href="{{ route('contact') }}" class="btn-primary py-2">Pedir demonstração</a>
                @endif
            </div>

            <details class="group lg:hidden">
                <summary class="flex cursor-pointer list-none items-center rounded-sm p-2 hover:bg-paper [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">
                    <x-heroicon-o-bars-3 class="size-7 group-open:hidden" />
                    <x-heroicon-o-x-mark class="hidden size-7 group-open:block" />
                </summary>
                <div class="absolute inset-x-0 top-[4.25rem] border-b border-line bg-white p-5 shadow-sheet">
                    @foreach (config('ordik.solutions', []) as $slug => $solution)
                        @if (Route::has('solutions.show'))
                            <a href="{{ route('solutions.show', $slug) }}" class="block py-2 font-medium">{{ $solution['name'] }}</a>
                        @endif
                    @endforeach
                    @foreach ($navExisting as $route => $label)
                        <a href="{{ route($route) }}" class="block py-2 font-medium">{{ $label }}</a>
                    @endforeach
                    @if (Route::has('contact'))
                        <a href="{{ route('contact') }}" class="btn-primary mt-3 w-full">Pedir demonstração</a>
                    @endif
                </div>
            </details>
        </div>
    </header>

    <main id="conteudo" class="flex-1">
        {{ $slot }}
    </main>

    <footer class="bg-indigo-950 text-indigo-100">
        <div class="container-site grid gap-10 py-14 md:grid-cols-12">
            <div class="md:col-span-5">
                <img src="/brand/ordik-logo-white.svg" alt="Ordik" width="119" height="40" loading="lazy" class="-ml-1 h-10 w-auto">
                <p class="mt-4 max-w-sm text-sm">ERP para pequenas e médias empresas. Vendas, estoque, compras, ordens de serviço, frente de caixa, CRM e financeiro no mesmo sistema.</p>
            </div>
            <nav class="md:col-span-3" aria-label="Produto">
                <h2 class="font-semibold text-white">Produto</h2>
                <ul class="mt-3 space-y-1.5 text-sm">
                    @foreach ($navExisting as $route => $label)
                        <li><a href="{{ route($route) }}" class="hover:text-white hover:underline">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </nav>
            <nav class="md:col-span-4" aria-label="Institucional">
                <h2 class="font-semibold text-white">Fale com a gente</h2>
                <ul class="mt-3 space-y-1.5 text-sm">
                    <li><a href="mailto:{{ config('ordik.contact_email', 'comercial@ordik.com.br') }}" class="hover:text-white hover:underline">{{ config('ordik.contact_email', 'comercial@ordik.com.br') }}</a></li>
                    @if (Route::has('contact'))
                        <li><a href="{{ route('contact') }}" class="hover:text-white hover:underline">Pedir demonstração</a></li>
                    @endif
                    @if (Route::has('privacy'))
                        <li><a href="{{ route('privacy') }}" class="hover:text-white hover:underline">Privacidade</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-white hover:underline">Termos de uso</a></li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="border-t border-indigo-800">
            <p class="container-site py-5 text-xs">&copy; {{ date('Y') }} Ordik. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
