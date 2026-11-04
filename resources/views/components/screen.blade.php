@props(['src', 'alt', 'caption' => null, 'width' => 1600, 'height' => 1111, 'eager' => false])

{{-- Captura real do sistema. Sem moldura de navegador: o Ordik roda como app instalado. --}}
<figure {{ $attributes }}>
    <img src="/images/produto/{{ $src }}.webp" alt="{{ $alt }}" width="{{ $width }}" height="{{ $height }}"
        @if ($eager) fetchpriority="high" @else loading="lazy" decoding="async" @endif
        class="w-full rounded-lg border border-line bg-white shadow-sheet">
    @if ($caption)
        <figcaption class="mt-3 max-w-prose text-sm text-muted">{{ $caption }}</figcaption>
    @endif
</figure>
