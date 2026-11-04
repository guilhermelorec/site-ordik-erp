@props(['items', 'title' => 'Perguntas frequentes'])

<section class="container-site band grid gap-8 lg:grid-cols-12">
    <h2 class="title-section lg:col-span-4">{{ $title }}</h2>
    <div class="lg:col-span-7 lg:col-start-6">
        @foreach ($items as $question => $answer)
            <details class="group border-t border-line last:border-b">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-4 py-4 text-lg font-medium [&::-webkit-details-marker]:hidden">
                    {{ $question }}
                    <x-heroicon-m-plus class="size-5 shrink-0 text-indigo-600 group-open:hidden" />
                    <x-heroicon-m-minus class="hidden size-5 shrink-0 text-indigo-600 group-open:block" />
                </summary>
                <p class="max-w-prose pb-5 text-muted">{{ $answer }}</p>
            </details>
        @endforeach
    </div>
</section>
