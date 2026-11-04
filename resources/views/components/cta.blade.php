@props([
    'title' => 'Veja o Ordik seguindo a rotina da sua empresa',
    'text' => 'Conte como vocês vendem e controlam estoque hoje. A demonstração segue esse caminho.',
])

<section id="demonstracao" class="container-site mt-16 lg:mt-24">
    <div class="grid gap-10 rounded-xl bg-indigo-950 p-6 text-white sm:p-10 lg:grid-cols-12 lg:p-14">
        <div class="lg:col-span-5">
            <h2 class="title-section">{{ $title }}</h2>
            <p class="mt-5 text-lg text-indigo-100">{{ $text }}</p>
            <p class="mt-5 text-sm text-indigo-100">Respondemos em até 1 dia útil.</p>
        </div>
        <div class="lg:col-span-7">
            <x-lead-form dark />
        </div>
    </div>
</section>
