<x-layouts.app title="Página não encontrada" description="Esta página não existe ou mudou de endereço.">
    <section class="container-site band">
        <h1 class="title-display max-w-3xl">Esta página não existe ou mudou de endereço</h1>
        <p class="lead mt-5 max-w-xl">Confira o endereço digitado ou siga por um destes caminhos.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('home') }}" class="btn-primary">Ir para o início</a>
            <a href="{{ route('features') }}" class="btn-outline">Ver funcionalidades</a>
        </div>
    </section>
</x-layouts.app>
