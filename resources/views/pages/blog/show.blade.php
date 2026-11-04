<x-layouts.app :title="$post->title" :description="$post->summary" type="article">
    <x-slot:head>
        <x-json-ld :data="[
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->summary,
            'datePublished' => $post->date->toDateString(),
            'author' => ['@type' => 'Organization', 'name' => 'Ordik'],
            'publisher' => ['@type' => 'Organization', 'name' => 'Ordik', 'logo' => ['@type' => 'ImageObject', 'url' => url('/brand/ordik-icon-512.png')]],
            'mainEntityOfPage' => route('blog.show', $post->slug),
            'image' => url('/images/og-default.png'),
        ]" />
    </x-slot:head>

    <article class="container-site py-12 lg:py-16">
        <a href="{{ route('blog.index') }}" class="link-underline text-sm">Todos os textos</a>
        <h1 class="title-page mt-5 max-w-3xl">{{ $post->title }}</h1>
        <p class="mt-3 text-sm text-muted"><time datetime="{{ $post->date->toDateString() }}">{{ $post->date->translatedFormat('d \d\e F \d\e Y') }}</time></p>
        <div class="prose-ordik mt-8">{!! $post->html !!}</div>
    </article>

    <x-cta title="Quer ver isso funcionando?" text="Mostramos como o Ordik cuida dessa parte da rotina, com o seu jeito de trabalhar." />
</x-layouts.app>
