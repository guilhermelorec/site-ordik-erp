@props(['title', 'text' => null])

<section class="bg-indigo-950 text-white">
    <div class="container-site py-12 lg:py-16">
        <h1 class="title-page max-w-3xl">{{ $title }}</h1>
        @if ($text)
            <p class="mt-5 max-w-2xl text-lg text-indigo-100">{{ $text }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
