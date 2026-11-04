<x-layouts.app title="Termos de Uso" description="Condições de uso do site da Ordik.">
    <article class="container-site py-12 lg:py-16">
        <h1 class="title-page">Termos de Uso</h1>
        <div class="prose-ordik mt-8">
            <p>Estes termos valem para o uso deste site. A contratação do Ordik ERP é regida pela proposta e pelo contrato firmados com cada cliente.</p>
            <h2>Uso do site</h2>
            <p>O site apresenta a Ordik e seus produtos. Ao enviar o formulário, você declara que as informações são verdadeiras e que tem autorização para falar em nome da empresa informada.</p>
            <h2>Informações sobre o produto</h2>
            <p>Procuramos manter as descrições atualizadas. As telas mostram dados de demonstração, e as funcionalidades incluídas em cada contratação constam na proposta.</p>
            <h2>Propriedade intelectual</h2>
            <p>Marca, logotipo, textos e imagens pertencem à Ordik e não podem ser usados sem autorização.</p>
            <h2>Contato</h2>
            <p>Dúvidas podem ser enviadas para <a href="mailto:{{ config('ordik.contact_email') }}">{{ config('ordik.contact_email') }}</a>.</p>
        </div>
    </article>
</x-layouts.app>
