@props([
    'title' => 'Veja o Ordik seguindo a rotina da sua empresa',
    'text' => 'Conte como vocês vendem e controlam estoque hoje. A demonstração segue esse caminho.',
])

<section id="demonstracao" class="bg-indigo-950 text-white">
    <div class="container-site band grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <h2 class="title-section">{{ $title }}</h2>
            <p class="mt-5 text-lg text-indigo-100">{{ $text }}</p>
            <p class="mt-5 text-sm text-indigo-100">Respondemos em até 1 dia útil.</p>
        </div>
        <div class="lg:col-span-6 lg:col-start-7">
            <x-lead-form id="pedido-rodape" dark />
        </div>
    </div>
</section>
