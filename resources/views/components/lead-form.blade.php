@props(['dark' => false])

@php($id = 'pedido')

{{-- Formulário de lead: um por página, e o envio sempre volta para #pedido. --}}
<form id="{{ $id }}" method="POST" action="{{ route('contact.store') }}" novalidate
    {{ $attributes->class(['bg-white p-6 text-ink sm:p-8 rounded-md', 'shadow-sheet' => ! $dark]) }}>
    @csrf
    {{-- Honeypot: invisível para pessoas, bots costumam preencher. --}}
    <div class="hidden" aria-hidden="true">
        <label for="{{ $id }}-website">Não preencha este campo</label>
        <input type="text" name="website" id="{{ $id }}-website" tabindex="-1" autocomplete="off">
    </div>

    @if (session('success'))
        <div class="mb-6 flex gap-3 rounded-sm bg-indigo-100 p-4 text-sm font-medium" role="status">
            <x-heroicon-s-check-circle class="size-5 shrink-0 text-paid" /> {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-5 sm:grid-cols-2">
        @foreach ([
            ['name', 'Seu nome', 'text', 'name'],
            ['company', 'Empresa', 'text', 'organization'],
            ['email', 'E-mail', 'email', 'email'],
            ['whatsapp', 'WhatsApp com DDD', 'tel', 'tel'],
        ] as [$field, $label, $type, $autocomplete])
            <div>
                <label for="{{ $id }}-{{ $field }}" class="block text-sm font-medium">{{ $label }}</label>
                <input type="{{ $type }}" name="{{ $field }}" id="{{ $id }}-{{ $field }}" value="{{ old($field) }}" autocomplete="{{ $autocomplete }}" required
                    @error($field) aria-invalid="true" aria-describedby="{{ $id }}-{{ $field }}-error" @enderror
                    class="field @error($field) border-danger @enderror">
                @error($field)
                    <p id="{{ $id }}-{{ $field }}-error" class="mt-1.5 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        @foreach ([
            ['segment', 'Segmento', \App\Models\Lead::SEGMENTS],
            ['branches', 'Unidades', \App\Models\Lead::BRANCHES],
        ] as [$field, $label, $options])
            <div>
                <label for="{{ $id }}-{{ $field }}" class="block text-sm font-medium">{{ $label }}</label>
                <select name="{{ $field }}" id="{{ $id }}-{{ $field }}" required
                    @error($field) aria-invalid="true" aria-describedby="{{ $id }}-{{ $field }}-error" @enderror
                    class="field @error($field) border-danger @enderror">
                    <option value="">Selecione</option>
                    @foreach ($options as $option)
                        <option value="{{ $option }}" @selected(old($field) === $option)>{{ $option }}</option>
                    @endforeach
                </select>
                @error($field)
                    <p id="{{ $id }}-{{ $field }}-error" class="mt-1.5 text-sm text-danger">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <div class="sm:col-span-2">
            <label for="{{ $id }}-message" class="block text-sm font-medium">O que você quer resolver? <span class="font-normal text-muted">(opcional)</span></label>
            <textarea name="message" id="{{ $id }}-message" rows="3" class="field @error('message') border-danger @enderror"
                placeholder="Ex.: controlamos estoque em planilha e queremos ligar o caixa ao financeiro">{{ old('message') }}</textarea>
            @error('message')
                <p class="mt-1.5 text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-primary mt-6 w-full sm:w-auto">Pedir demonstração</button>
    <p class="mt-3 text-xs text-muted">Usamos seus dados só para responder a este pedido. Veja a <a href="{{ route('privacy') }}" class="underline">política de privacidade</a>.</p>
</form>
