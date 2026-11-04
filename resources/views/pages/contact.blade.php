<x-layouts.app title="Pedir demonstração" description="Peça uma demonstração do Ordik ERP com a rotina da sua empresa: vendas, estoque, ordens de serviço, frente de caixa, CRM e financeiro. Retorno em até 1 dia útil.">
    <section class="container-site grid gap-12 py-14 lg:grid-cols-12 lg:py-20">
        <div class="lg:col-span-5">
            <h1 class="title-page">Veja o Ordik com a rotina da sua empresa</h1>
            <p class="lead mt-5">Conte como vocês vendem e controlam estoque hoje. Na demonstração, seguimos esse caminho dentro do sistema.</p>

            <h2 class="mt-10 font-semibold">Como funciona</h2>
            <ol class="mt-4 space-y-4">
                @foreach ([
                    'Respondemos em até 1 dia útil para combinar o horário.',
                    'Mostramos o sistema seguindo os processos que você descreveu.',
                    'Você recebe a proposta com escopo, implantação e treinamento.',
                ] as $step)
                    <li class="flex gap-4">
                        <span class="numeric font-display text-h3 leading-none font-semibold text-indigo-600">{{ $loop->iteration }}</span>
                        <span>{{ $step }}</span>
                    </li>
                @endforeach
            </ol>

            <p class="mt-10 text-sm text-muted">Prefere e-mail? Escreva para <a href="mailto:{{ config('ordik.contact_email') }}" class="link-underline">{{ config('ordik.contact_email') }}</a>.</p>
        </div>

        <div class="lg:col-span-6 lg:col-start-7">
            <x-lead-form />
        </div>
    </section>
</x-layouts.app>
