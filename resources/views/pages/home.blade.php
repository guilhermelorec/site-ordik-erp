<x-layouts.app>
    <x-slot:head>
        <x-json-ld :data="[
            '@type' => 'Organization',
            'name' => 'Ordik',
            'url' => route('home'),
            'logo' => url('/brand/ordik-icon-512.png'),
            'email' => config('ordik.contact_email'),
        ]" />
        <x-json-ld :data="[
            '@type' => 'SoftwareApplication',
            'name' => 'Ordik ERP',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Windows',
            'description' => 'ERP on-premise para pequenas e médias empresas, com vendas, estoque, compras, ordens de serviço, PDV, CRM e financeiro integrados.',
            'url' => route('home'),
        ]" />
        <x-json-ld :data="[
            '@type' => 'FAQPage',
            'mainEntity' => collect(config('ordik.faq'))->map(fn (string $answer, string $question) => [
                '@type' => 'Question',
                'name' => $question,
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $answer],
            ])->values()->all(),
        ]" />
    </x-slot:head>

    <section class="container-site grid items-center gap-12 pt-10 pb-14 lg:grid-cols-12 lg:gap-8 lg:pt-16 lg:pb-20">
        <div class="lg:col-span-6">
            <p class="pill bg-indigo-600 text-white">Instalado na sua empresa</p>
            <h1 class="title-display mt-5">Venda, estoque e financeiro no mesmo sistema</h1>
            <p class="lead mt-5 max-w-[34rem]">O Ordik é o ERP para pequenas e médias empresas que querem parar de digitar a mesma informação em vários lugares.</p>
            <ul class="mt-6 flex flex-wrap gap-x-5 gap-y-2 text-sm font-medium text-indigo-800">
                @foreach (['Vendas e CRM', 'Estoque e compras', 'Frente de caixa', 'Ordens de serviço', 'Financeiro'] as $item)
                    <li class="flex items-center gap-1.5"><x-heroicon-m-check class="size-4" /> {{ $item }}</li>
                @endforeach
            </ul>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="#demonstracao" class="btn-tag">Pedir demonstração</a>
                <a href="{{ route('features') }}" class="btn-outline">Ver funcionalidades</a>
            </div>
            <p class="mt-3 text-sm text-muted">Retorno em até 1 dia útil.</p>
        </div>

        <div class="relative lg:col-span-6">
            <img src="/images/produto/dashboard.webp" alt="Dashboard do Ordik ERP com faturamento, contas e gráficos" width="1600" height="1111" fetchpriority="high"
                class="aspect-[4/3] w-full rounded-lg object-cover object-left-top shadow-sheet">
            {{-- Recortes ilustrativos do que o sistema faz: mesmos valores da venda de exemplo. --}}
            <div aria-hidden="true" class="numeric absolute -bottom-6 left-4 w-56 rounded-md bg-white p-4 text-sm shadow-float sm:-left-6">
                <p class="flex items-center justify-between font-semibold">Venda #1042 <span class="pill bg-paid px-2.5 py-0.5 text-xs text-white">Confirmada</span></p>
                <p class="mt-1 text-muted">Total R$ 574,40</p>
            </div>
            <div aria-hidden="true" class="numeric absolute top-6 -right-2 hidden w-52 rounded-md bg-white p-4 text-sm shadow-float sm:block lg:-right-6">
                <p class="font-semibold">Estoque atualizado</p>
                <p class="mt-1 flex justify-between text-muted">SSD 480GB <span><s>30</s> <strong class="rounded-sm bg-tag px-1 font-semibold text-ink">28</strong></span></p>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <ul class="container-site flex flex-wrap justify-between gap-x-8 gap-y-3 py-7 font-display font-semibold text-muted">
            @foreach (config('ordik.modules') as $module)
                <li>{{ $module['name'] }}</li>
            @endforeach
        </ul>
    </section>

    <section class="container-site band">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="title-section">Confirme uma venda e veja o que acontece</h2>
            <p class="lead mt-4">Quem vende não precisa avisar o estoque, e o financeiro não precisa perguntar o que foi vendido.</p>
        </div>
        <div class="mx-auto mt-10 max-w-4xl">
            <x-hero-demo />
        </div>
        <ul class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (config('ordik.chain') as [$event, $stock, $money])
                <li>
                    <p class="font-semibold">{{ $event }}</p>
                    <p class="mt-1 text-sm text-muted">{{ $stock }}</p>
                    <p class="text-sm text-muted">{{ $money }}</p>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="bg-white">
        <div class="container-site band">
            <h2 class="title-section mx-auto max-w-2xl text-center">Tudo que a operação faz, conectado no mesmo lugar</h2>

            <div data-pillars class="relative mt-12 lg:min-h-[32rem]">
                @foreach (config('ordik.pillars') as $name => $pillar)
                    <details name="pillars" @if ($loop->first) open @endif class="group mb-3 rounded-md bg-paper p-5 open:bg-indigo-50 lg:w-[38%]">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-3 [&::-webkit-details-marker]:hidden">
                            <span>
                                <span class="pill bg-white text-indigo-800">{{ $name }}</span>
                                <span class="title-block mt-2 block">{{ $pillar['title'] }}</span>
                            </span>
                            <x-heroicon-m-chevron-down class="size-5 shrink-0 text-indigo-600 group-open:hidden" />
                        </summary>
                        <p class="mt-3 text-muted">{{ $pillar['text'] }}</p>
                        <ul class="mt-3 space-y-1">
                            @foreach ($pillar['modules'] as $slug)
                                <li><a href="{{ route('features') }}#{{ $slug }}" class="link-underline text-sm">{{ config("ordik.modules.$slug.name") }}</a></li>
                            @endforeach
                        </ul>
                        <div class="mt-5 lg:absolute lg:top-0 lg:right-0 lg:mt-0 lg:w-[58%]">
                            <img src="/images/produto/{{ $pillar['image'] }}.webp" alt="{{ $pillar['alt'] }}" width="1600" height="1111" loading="lazy" decoding="async" class="w-full rounded-lg shadow-sheet">
                        </div>
                    </details>
                @endforeach
            </div>
            <p class="mt-4 text-sm text-muted lg:text-right">Telas reais do sistema, com dados de demonstração.</p>
        </div>
    </section>

    <section class="container-site band">
        <ul class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (config('ordik.benefits') as [$icon, $title, $text])
                <li class="card">
                    <x-dynamic-component :component="$icon" class="size-7 text-indigo-600" />
                    <h3 class="mt-4 text-lg font-semibold">{{ $title }}</h3>
                    <p class="mt-2 text-muted">{{ $text }}</p>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="bg-indigo-950 text-white">
        <div class="container-site band">
            <h2 class="title-section mx-auto max-w-2xl text-center">Todos os recursos que a sua empresa precisa no dia a dia</h2>
            <div class="mt-10 space-y-8">
                @foreach (config('ordik.pillars') as $name => $pillar)
                    <div class="grid gap-3 lg:grid-cols-[8rem_1fr] lg:items-start">
                        <h3 class="pt-1.5 font-semibold text-tag">{{ $name }}</h3>
                        <ul class="flex flex-wrap gap-2">
                            @foreach ($pillar['modules'] as $slug)
                                @foreach (array_keys(config("ordik.modules.$slug.features")) as $feature)
                                    <li><a href="{{ route('features') }}#{{ $slug }}" class="pill bg-white/10 text-white hover:bg-white/20">{{ $feature }}</a></li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="para-quem" class="container-site band">
        <h2 class="title-section mx-auto max-w-2xl text-center">Uma rotina completa para cada tipo de negócio</h2>
        <div class="mt-12 grid gap-5 lg:grid-cols-3">
            @foreach (config('ordik.solutions') as $slug => $solution)
                <article class="card flex flex-col">
                    <h3 class="title-block">{{ $solution['name'] }}</h3>
                    <ol class="mt-5 flex-1 space-y-3">
                        @foreach ($solution['journey'] as $step)
                            <li class="flex gap-3">
                                <span class="numeric w-4 shrink-0 font-semibold text-indigo-600">{{ $loop->iteration }}</span>
                                <span>{{ $step }}</span>
                            </li>
                        @endforeach
                    </ol>
                    <a href="{{ route('solutions.show', $slug) }}" class="link-underline mt-5 inline-block">Ordik para {{ Str::lower($solution['name']) }}</a>
                </article>
            @endforeach
        </div>
    </section>

    <section class="container-site">
        <div class="grid items-center gap-8 overflow-hidden rounded-xl bg-indigo-950 text-white lg:grid-cols-2">
            <div class="p-6 sm:p-10 lg:p-14">
                <p class="pill bg-tag text-ink">Implantação</p>
                <h2 class="title-section mt-4">Instalado na sua empresa. Os dados ficam com você.</h2>
                <p class="mt-4 text-lg text-indigo-100">Um instalador coloca o sistema e o banco de dados em um computador seu. Os outros acessam pela rede local, mesmo com a internet fora do ar.</p>
                <a href="{{ route('implantation') }}" class="btn-tag mt-7">Como funciona a implantação</a>
            </div>
            <img src="/images/produto/pdv.webp" alt="Terminal de frente de caixa do Ordik com itens lançados" width="1600" height="1000" loading="lazy" decoding="async" class="h-full w-full object-cover object-left-top">
        </div>
    </section>

    <x-faq :items="config('ordik.faq')" />

    <x-cta />
</x-layouts.app>
