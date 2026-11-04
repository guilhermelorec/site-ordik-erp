<x-layouts.app title="Funcionalidades do ERP" description="Conheça os módulos do Ordik ERP: CRM, vendas, controle de estoque, compras, ordens de serviço, PDV, financeiro e gestão por empresa e filial.">
    <x-page-hero title="Tudo o que a operação precisa, sem sistema paralelo" text="Cada módulo usa os mesmos cadastros e conversa com os outros. O que você registra em um lugar já aparece onde precisa aparecer." />

    <nav class="sticky top-[4.25rem] z-30 border-b border-line bg-white" aria-label="Módulos">
        <ul class="container-site flex gap-5 overflow-x-auto py-3 text-sm font-medium whitespace-nowrap">
            @foreach (config('ordik.modules') as $slug => $module)
                <li><a href="#{{ $slug }}" class="hover:text-indigo-600">{{ $module['name'] }}</a></li>
            @endforeach
        </ul>
    </nav>

    @foreach (config('ordik.modules') as $slug => $module)
        <section id="{{ $slug }}" @class(['scroll-mt-32', 'bg-white' => $loop->even])>
            <div class="container-site band grid gap-10 lg:grid-cols-12">
                <div @class(['lg:col-span-5' => $module['image'], 'lg:col-span-4' => ! $module['image']])>
                    <h2 class="title-section">{{ $module['name'] }}</h2>
                    <p class="lead mt-4">{{ $module['description'] }}</p>
                    @if ($slug === 'pdv')
                        <a href="{{ route('pdv') }}" class="link-underline mt-5 inline-block">Ver a frente de caixa em detalhes</a>
                    @endif
                </div>

                @if ($module['image'])
                    <x-screen :src="$module['image']" :alt="$module['alt']" :height="$module['image'] === 'pdv' ? 1000 : 1111" class="lg:col-span-7" />
                @endif

                <dl @class([
                    'grid gap-x-10 gap-y-6',
                    'sm:grid-cols-2 lg:col-span-12 lg:grid-cols-3' => $module['image'],
                    'sm:grid-cols-2 lg:col-span-7 lg:col-start-6' => ! $module['image'],
                ])>
                    @foreach ($module['features'] as $name => $text)
                        <div class="border-t border-ink/20 pt-3">
                            <dt class="font-semibold">{{ $name }}</dt>
                            <dd class="mt-1 text-muted">{{ $text }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </section>
    @endforeach

    <x-cta />
</x-layouts.app>
