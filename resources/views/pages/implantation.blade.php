<x-layouts.app title="Implantação do ERP" description="Como o Ordik ERP é instalado na sua empresa: requisitos de computador, rede local, cadastro inicial, testes, treinamento da equipe e backup diário.">
    <x-page-hero title="O sistema roda na sua empresa, no seu computador" text="O instalador coloca o Ordik e o banco de dados em um Windows seu. Os demais computadores acessam pela rede local, sem depender de internet no dia a dia." />

    <section class="container-site band grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <h2 class="title-section">Do pedido à primeira venda</h2>
            <p class="lead mt-4">Cada etapa termina com algo que você consegue testar.</p>
        </div>
        <ol class="lg:col-span-7 lg:col-start-6">
            @foreach ([
                ['Preparar', 'Conferimos o computador que será o servidor e os terminais que vão acessá-lo.'],
                ['Instalar', 'O instalador configura o sistema e o banco de dados, com a conta de administrador da empresa.'],
                ['Ligar a rede', 'Definimos um IP fixo para o servidor e liberamos o acesso dos outros computadores.'],
                ['Cadastrar', 'Criamos empresa, filiais e usuários, cada um com o perfil certo.'],
                ['Testar', 'Fazemos uma venda e uma compra de ponta a ponta antes de começar a operar.'],
                ['Proteger', 'Agendamos o backup diário e testamos a cópia manual.'],
            ] as [$step, $text])
                <li class="grid gap-1 border-t border-line py-4 last:border-b sm:grid-cols-[11rem_1fr] sm:gap-6">
                    <h3 class="title-block"><span class="numeric text-indigo-600">{{ $loop->iteration }}.</span> {{ $step }}</h3>
                    <p class="self-center text-muted">{{ $text }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    <section class="bg-white">
        <div class="container-site band grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <h2 class="title-section">O que você precisa ter</h2>
                <p class="lead mt-4">Na maioria dos casos, um computador atual da empresa resolve.</p>
            </div>
            <table class="lg:col-span-7 lg:col-start-6">
                <caption class="sr-only">Requisitos do computador</caption>
                <tbody>
                    @foreach ([
                        'Sistema' => 'Windows 10 ou 11, 64 bits',
                        'Memória' => '8 GB, ou 16 GB para servir outros computadores',
                        'Disco' => '10 GB livres, de preferência em SSD',
                        'Rede' => 'Rede local entre o servidor e os terminais',
                    ] as $item => $value)
                        <tr class="border-t border-line last:border-b">
                            <th scope="row" class="w-32 py-3 text-left font-semibold">{{ $item }}</th>
                            <td class="py-3">{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="container-site band grid gap-10 lg:grid-cols-12">
        <h2 class="title-section lg:col-span-5">Depois de instalado</h2>
        <dl class="grid gap-x-10 gap-y-6 sm:grid-cols-2 lg:col-span-7">
            @foreach ([
                'Backup diário' => 'A cópia do banco roda sozinha todos os dias, em um horário agendado.',
                'Atualização de versão' => 'O novo instalador roda sobre o atual, depois de um backup completo.',
                'Vários terminais' => 'O PDV pode rodar em outros computadores, ligados ao mesmo servidor.',
                'Dados sob seu controle' => 'Tudo fica no computador da empresa, inclusive os backups.',
            ] as $name => $text)
                <div class="border-t border-ink/20 pt-3">
                    <dt class="font-semibold">{{ $name }}</dt>
                    <dd class="mt-1 text-muted">{{ $text }}</dd>
                </div>
            @endforeach
        </dl>
    </section>

    <x-cta title="Tire suas dúvidas sobre a implantação" text="Conte quantas unidades e terminais vocês têm. Levamos isso para a demonstração e para a proposta." />
</x-layouts.app>
