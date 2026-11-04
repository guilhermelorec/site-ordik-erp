<x-layouts.app title="Sobre a empresa" description="A Ordik desenvolve um ERP para pequenas e médias empresas brasileiras, com vendas, estoque, serviços, caixa e financeiro integrados e instalados na empresa do cliente.">
    <x-page-hero title="Fazemos o sistema que a pequena e a média empresa conseguem usar" text="A Ordik desenvolve um ERP para quem vende, compra, presta serviço e precisa saber quanto sobrou no fim do mês, sem manter uma planilha para cada coisa." />

    <section class="container-site band grid gap-10 lg:grid-cols-12">
        <h2 class="title-section lg:col-span-5">Como pensamos o produto</h2>
        <dl class="lg:col-span-7">
            @foreach ([
                'Integrar antes de crescer' => 'Todo módulo novo precisa conversar com estoque, financeiro e cadastros. Se não conversa, não entra.',
                'Funcionar sem internet' => 'O que é essencial para a operação não pode parar porque a conexão caiu.',
                'Simples para quem usa todo dia' => 'O caixa vê o caixa, o vendedor vê a carteira dele. Quem precisa de mais encontra o resto no menu.',
                'Regras que evitam erro' => 'Um pedido só avança na ordem certa, e documento efetivado não é apagado. O histórico fica.',
            ] as $name => $text)
                <div class="grid gap-1 border-t border-line py-4 last:border-b sm:grid-cols-[15rem_1fr] sm:gap-6">
                    <dt class="font-semibold">{{ $name }}</dt>
                    <dd class="text-muted">{{ $text }}</dd>
                </div>
            @endforeach
        </dl>
    </section>

    <section class="bg-white">
        <div class="container-site band grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <h2 class="title-section">O que o Ordik ainda não faz</h2>
                <p class="lead mt-4">Preferimos dizer antes da demonstração. Assim você decide com a informação completa.</p>
            </div>
            <ul class="lg:col-span-6 lg:col-start-7">
                @foreach ([
                    'Emissão fiscal de NF-e, NFC-e e NFS-e',
                    'Conciliação bancária por arquivo OFX',
                    'Cobrança Pix integrada ao banco',
                    'Aplicativo para celular e portal do cliente',
                    'Transferência de estoque e preço por filial',
                ] as $item)
                    <li class="border-t border-line py-3 last:border-b">{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta title="Fale com a gente" text="Conte o que a sua empresa precisa resolver. Dizemos com clareza se o Ordik atende." />
</x-layouts.app>
