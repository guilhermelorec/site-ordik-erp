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
    </x-slot:head>

    <section class="container-site band">
        <h1 class="title-display">Ordik ERP</h1>
    </section>
</x-layouts.app>
