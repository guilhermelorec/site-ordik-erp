<x-layouts.app title="Política de Privacidade" description="Como o site da Ordik trata os dados enviados pelo formulário de demonstração.">
    <article class="container-site py-12 lg:py-16">
        <h1 class="title-page">Política de Privacidade</h1>
        <div class="prose-ordik mt-8">
            <p>Esta política explica como o site da Ordik trata os dados pessoais de quem pede uma demonstração. O sistema Ordik ERP é instalado na empresa do cliente, e os dados da operação ficam nesse ambiente.</p>
            <h2>Dados que coletamos</h2>
            <p>Pelo formulário, coletamos nome, empresa, e-mail, WhatsApp, segmento, número de unidades, a mensagem que você escrever e a página em que o pedido foi feito.</p>
            <h2>Para que usamos</h2>
            <p>Usamos esses dados para responder ao pedido, agendar a demonstração e enviar a proposta, com base no seu interesse em conhecer o produto. Não vendemos dados pessoais.</p>
            <h2>Com quem compartilhamos</h2>
            <p>Os dados ficam acessíveis à equipe comercial e aos fornecedores que hospedam o site e enviam e-mails em nosso nome, apenas na medida necessária para esses serviços.</p>
            <h2>Por quanto tempo guardamos</h2>
            <p>Mantemos os dados enquanto houver relação comercial ou até você pedir a exclusão, salvo quando a lei exigir guarda por mais tempo.</p>
            <h2>Seus direitos</h2>
            <p>Conforme a Lei Geral de Proteção de Dados, você pode pedir acesso, correção ou exclusão dos seus dados. Escreva para <a href="mailto:{{ config('ordik.contact_email') }}">{{ config('ordik.contact_email') }}</a>.</p>
            <h2>Cookies</h2>
            <p>O site usa apenas os cookies necessários para funcionar e proteger o formulário.</p>
        </div>
    </article>
</x-layouts.app>
