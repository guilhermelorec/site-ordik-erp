<x-layouts.app :title="$solution['title']" :description="$solution['description']">
    <x-page-hero :title="$solution['headline']" :text="$solution['intro']">
        <a href="#demonstracao" class="btn-tag mt-7">Pedir demonstração</a>
    </x-page-hero>

    <section class="container-site band grid items-start gap-10 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <h2 class="title-section">Como fica a rotina</h2>
            <ol class="mt-7 space-y-4">
                @foreach ($solution['journey'] as $step)
                    <li class="flex gap-4">
                        <span class="numeric font-display w-5 shrink-0 text-h3 leading-none font-semibold text-indigo-600">{{ $loop->iteration }}</span>
                        <span>{{ $step }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
        <x-screen :src="$solution['image']" :alt="$solution['alt']" :height="$solution['imageHeight']" caption="Tela real do sistema, com dados de demonstração." class="lg:col-span-7" eager />
    </section>

    <section class="bg-white">
        <div class="container-site band">
            <h2 class="title-section">Os módulos mais usados</h2>
            <div class="mt-10 grid gap-10 lg:grid-cols-3">
                @foreach ($solution['modules'] as $moduleSlug)
                    @php($module = config("ordik.modules.$moduleSlug"))
                    <article>
                        <h3 class="title-block"><a href="{{ route('features') }}#{{ $moduleSlug }}" class="hover:text-indigo-600">{{ $module['name'] }}</a></h3>
                        <p class="mt-2 text-muted">{{ $module['description'] }}</p>
                        <ul class="mt-4 space-y-1.5 text-sm">
                            @foreach (array_keys($module['features']) as $feature)
                                <li class="flex gap-2"><x-heroicon-m-check class="mt-0.5 size-4 shrink-0 text-paid" /> {{ $feature }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
            <p class="mt-10 text-muted">Todos os módulos estão no mesmo sistema. <a href="{{ route('features') }}" class="link-underline">Ver todas as funcionalidades</a></p>
        </div>
    </section>

    <x-json-ld :data="[
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Início', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $solution['name'], 'item' => route('solutions.show', $slug)],
        ],
    ]" />

    <x-cta :title="'Veja o Ordik em '.Str::lower($solution['name'])" />
</x-layouts.app>
