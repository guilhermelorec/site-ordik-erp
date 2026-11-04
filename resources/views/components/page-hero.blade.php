@props(['title', 'text' => null])

<section class="container-site pt-12 pb-4 lg:pt-16">
    <h1 class="title-page max-w-3xl">{{ $title }}</h1>
    @if ($text)
        <p class="lead mt-5 max-w-2xl">{{ $text }}</p>
    @endif
    {{ $slot }}
</section>
