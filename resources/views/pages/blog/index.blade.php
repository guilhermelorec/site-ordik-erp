<x-layouts.app title="Blog" description="Conteúdo prático sobre gestão de pequenas e médias empresas: controle de estoque, fluxo de caixa, DRE, vendas e escolha de ERP.">
    <x-page-hero title="Gestão sem complicação" text="Textos curtos sobre estoque, financeiro, vendas e rotina de quem toca a empresa." />

    <section class="container-site band">
        <ul class="max-w-4xl">
            @foreach ($posts as $post)
                <li class="border-t border-line py-6 last:border-b">
                    <time datetime="{{ $post->date->toDateString() }}" class="text-sm text-muted">{{ $post->date->translatedFormat('d \d\e F \d\e Y') }}</time>
                    <h2 class="title-block mt-1"><a href="{{ route('blog.show', $post->slug) }}" class="hover:text-indigo-600">{{ $post->title }}</a></h2>
                    <p class="mt-2 max-w-prose text-muted">{{ $post->summary }}</p>
                </li>
            @endforeach
        </ul>
    </section>
</x-layouts.app>
