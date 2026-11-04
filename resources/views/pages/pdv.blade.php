<x-layouts.app title="PDV e frente de caixa" description="Frente de caixa integrada ao ERP: leitor de código de barras, atalhos de teclado, pagamento misto, sangria, suprimento e fechamento conferido.">
    @php($pdv = config('ordik.modules.pdv'))

    <x-page-hero title="Uma frente de caixa feita para o teclado" text="{{ $pdv['description'] }}">
        <a href="#demonstracao" class="btn-tag mt-7">Pedir demonstração</a>
    </x-page-hero>

    <section class="container-site -mt-2 pt-12 lg:pt-16">
        <x-screen src="pdv" :alt="$pdv['alt']" :height="1000" caption="Tela real do terminal, com dados de demonstração." eager />
    </section>

    <section class="container-site band grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <h2 class="title-section">Sem mouse no balcão</h2>
            <p class="lead mt-4">O operador fica com as mãos no teclado e no leitor. Os atalhos abaixo já vêm prontos.</p>
        </div>
        <table class="numeric lg:col-span-6 lg:col-start-7">
            <caption class="sr-only">Atalhos de teclado do terminal</caption>
            <thead class="sr-only"><tr><th scope="col">Tecla</th><th scope="col">Ação</th></tr></thead>
            <tbody>
                @foreach ([
                    'F2' => 'Finalizar a venda',
                    'F3' => 'Identificar CPF ou CNPJ na nota',
                    'F4' => 'Sangria',
                    'F5' => 'Suprimento',
                    'F6' => 'Fechar o caixa',
                    'F9' => 'Abrir o caixa',
                    '+ / −' => 'Mudar a quantidade do último item',
                ] as $key => $action)
                    <tr class="border-t border-line last:border-b">
                        <th scope="row" class="w-24 py-2.5 text-left"><kbd class="rounded-sm border border-ink/25 bg-white px-2 py-0.5 font-sans font-semibold">{{ $key }}</kbd></th>
                        <td class="py-2.5">{{ $action }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="bg-white">
        <div class="container-site band">
            <h2 class="title-section max-w-2xl">Do primeiro item ao caixa fechado</h2>
            <ol class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Abrir', 'Escolha o terminal e informe o fundo de troco. Sem caixa aberto, não há venda.'],
                    ['Vender', 'Leia os produtos, ajuste quantidades e identifique o cliente se ele pedir.'],
                    ['Receber', 'Combine dinheiro, cartão e Pix até fechar o total. O cupom é impresso em seguida.'],
                    ['Fechar', 'Informe o valor contado na gaveta para encerrar a sessão do operador.'],
                ] as [$step, $text])
                    <li class="border-t-2 border-indigo-600 pt-3">
                        <h3 class="title-block"><span class="numeric text-indigo-600">{{ $loop->iteration }}.</span> {{ $step }}</h3>
                        <p class="mt-2 text-muted">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="container-site band grid gap-8 lg:grid-cols-12">
        <h2 class="title-section lg:col-span-5">O que mais vem no terminal</h2>
        <dl class="grid gap-x-10 gap-y-6 sm:grid-cols-2 lg:col-span-7">
            @foreach ($pdv['features'] as $name => $text)
                <div class="border-t border-ink/20 pt-3">
                    <dt class="font-semibold">{{ $name }}</dt>
                    <dd class="mt-1 text-muted">{{ $text }}</dd>
                </div>
            @endforeach
        </dl>
    </section>

    <x-cta title="Veja o terminal funcionando" text="Mostramos uma venda completa, da leitura do código ao fechamento do caixa." />
</x-layouts.app>
