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

    <section class="bg-indigo-950 text-white">
        <div class="container-site grid items-center gap-10 py-12 lg:grid-cols-12 lg:gap-8 lg:py-20">
            <div class="lg:col-span-6">
                <h1 class="title-display">Confirme a venda. Estoque e financeiro acompanham.</h1>
                <p class="mt-6 max-w-[34rem] text-lg text-indigo-100">O Ordik é um ERP para pequenas e médias empresas. Vendas, compras, ordens de serviço e caixa atualizam o resto do sistema, sem ninguém digitar duas vezes.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#demonstracao" class="btn-tag">Pedir demonstração</a>
                    <a href="{{ route('features') }}" class="btn-outline-dark">Ver funcionalidades</a>
                </div>
            </div>
            <div class="lg:col-span-6">
                <p class="mb-3 text-sm text-indigo-100">Teste aqui: confirme a venda e veja o que muda.</p>
                <x-hero-demo />
            </div>
        </div>
    </section>

    <section class="container-site band">
        <div class="max-w-2xl">
            <h2 class="title-section">Cada documento já resolve o que vem depois</h2>
            <p class="lead mt-4">Quem vende não precisa avisar o estoque, e o financeiro não precisa perguntar o que foi vendido.</p>
        </div>

        <table class="mt-10 w-full text-left">
            <thead class="text-sm text-muted max-sm:sr-only">
                <tr>
                    <th scope="col" class="w-2/5 pb-3 font-medium">Quando você</th>
                    <th scope="col" class="pb-3 font-medium">Estoque</th>
                    <th scope="col" class="pb-3 font-medium">Financeiro</th>
                </tr>
            </thead>
            <tbody>
                @foreach (config('ordik.chain') as [$event, $stock, $money])
                    <tr class="border-t border-ink/20 max-sm:block max-sm:py-4">
                        <th scope="row" class="py-4 pr-6 font-display text-h3 font-semibold max-sm:block max-sm:p-0">{{ $event }}</th>
                        <td class="py-4 pr-6 sm:text-lg max-sm:mt-2 max-sm:block max-sm:p-0"><span class="text-muted sm:hidden">Estoque: </span>{{ $stock }}</td>
                        <td class="py-4 sm:text-lg max-sm:block max-sm:p-0"><span class="text-muted sm:hidden">Financeiro: </span>{{ $money }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="overflow-hidden bg-white">
        <div class="container-site band grid items-center gap-10 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <h2 class="title-section">Abra o sistema e veja como a empresa está</h2>
                <p class="lead mt-4">O dashboard reúne faturamento, ticket médio, contas e produtos abaixo do mínimo. Escolha uma filial, uma empresa ou o grupo inteiro.</p>
                <a href="{{ route('features') }}#gestao" class="link-underline mt-6 inline-block">Ver gestão e acessos</a>
            </div>
            <x-screen src="dashboard" alt="Dashboard do Ordik ERP com faturamento, ticket médio, contas a receber e a pagar e gráficos mensais" caption="Tela real do sistema, com dados de demonstração." class="lg:col-span-8 lg:-mr-24 xl:-mr-40" />
        </div>
    </section>

    <section id="modulos" class="container-site band grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <div class="lg:sticky lg:top-28">
                <h2 class="title-section">O que vem no Ordik</h2>
                <p class="lead mt-4">Um cadastro de cliente, produto e fornecedor serve para todos os módulos.</p>
            </div>
        </div>
        <ul class="lg:col-span-7 lg:col-start-6">
            @foreach (config('ordik.modules') as $slug => $module)
                <li class="border-t border-line last:border-b">
                    <a href="{{ $slug === 'pdv' ? route('pdv') : route('features').'#'.$slug }}" class="group grid gap-1 py-4 sm:grid-cols-[13rem_1fr] sm:gap-6">
                        <span class="font-display text-h3 font-semibold group-hover:text-indigo-600">{{ $module['name'] }}</span>
                        <span class="self-center text-muted">{{ $module['summary'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    <section id="para-quem" class="bg-white">
        <div class="container-site band">
            <h2 class="title-section max-w-2xl">Três rotinas que o Ordik acompanha do começo ao fim</h2>
            <div class="mt-12 grid gap-12 lg:grid-cols-3 lg:gap-10">
                @foreach (config('ordik.solutions') as $slug => $solution)
                    <article>
                        <h3 class="title-block">{{ $solution['name'] }}</h3>
                        <ol class="mt-5 space-y-3">
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
        </div>
    </section>

    <section class="bg-tag">
        <div class="container-site band grid gap-8 lg:grid-cols-12">
            <h2 class="title-display lg:col-span-7">Instalado na sua empresa. Os dados ficam com você.</h2>
            <div class="lg:col-span-4 lg:col-start-9">
                <p class="text-lg">Um instalador coloca o sistema e o banco de dados em um computador seu. Os outros acessam pela rede local, mesmo com a internet fora do ar.</p>
                <a href="{{ route('implantation') }}" class="btn mt-6 bg-ink text-white hover:bg-indigo-950">Como funciona a implantação</a>
            </div>
        </div>
    </section>

    <x-faq :items="config('ordik.faq')" />

    <x-cta />
</x-layouts.app>
