@php
    $items = [
        ['SSD 480GB SATA', 2, '219,90', '439,80', 30],
        ['Cabo HDMI 2m', 3, '24,90', '74,70', 100],
        ['Teclado ABNT2 USB', 1, '59,90', '59,90', 40],
    ];
@endphp

{{-- Demonstração da promessa do produto. Toda a mudança visual sai do atributo data-done (ver app.js). --}}
<div data-demo class="group/demo overflow-hidden rounded-lg bg-white text-ink shadow-sheet">
    <div class="grid sm:grid-cols-[1.25fr_1fr]">
        <div class="p-5 sm:p-6">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="font-display text-h3 font-semibold">Venda #1042</p>
                    <p class="text-sm text-muted">Mercado Bela Vista</p>
                </div>
                <p class="rounded-full bg-indigo-100 px-3 py-0.5 text-sm font-medium text-indigo-800 group-data-done/demo:hidden">Aberta</p>
                <p class="hidden rounded-full bg-paid px-3 py-0.5 text-sm font-medium text-white group-data-done/demo:block">Confirmada</p>
            </div>

            <table class="numeric mt-5 w-full text-sm">
                <caption class="sr-only">Itens da venda</caption>
                <thead class="sr-only">
                    <tr><th scope="col">Produto</th><th scope="col">Quantidade e preço</th><th scope="col">Total</th></tr>
                </thead>
                <tbody>
                    @foreach ($items as [$name, $qty, $price, $total])
                        <tr class="border-t border-line">
                            <td class="py-2 pr-2 font-medium">{{ $name }}</td>
                            <td class="py-2 pr-2 whitespace-nowrap text-muted">{{ $qty }} × {{ $price }}</td>
                            <td class="py-2 text-right whitespace-nowrap">{{ $total }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-ink">
                        <th scope="row" colspan="2" class="pt-2.5 text-left font-semibold">Total</th>
                        <td class="pt-2.5 text-right text-lg font-semibold whitespace-nowrap">R$ 574,40</td>
                    </tr>
                </tfoot>
            </table>

            <button type="button" data-demo-confirm class="btn-tag mt-5 w-full group-data-done/demo:hidden">Confirmar venda</button>
            <button type="button" data-demo-reset class="btn-outline mt-5 hidden w-full group-data-done/demo:inline-flex">Reabrir o exemplo</button>
        </div>

        <div class="border-t border-line bg-paper p-5 sm:border-t-0 sm:border-l sm:p-6">
            <h3 class="font-semibold">Estoque</h3>
            <ul class="numeric mt-2 text-sm">
                @foreach ($items as $index => [$name, $qty, , , $stock])
                    <li class="flex justify-between gap-3 py-1">
                        <span>{{ Str::before($name, ' ') }}</span>
                        <span>
                            <span class="group-data-done/demo:text-muted group-data-done/demo:line-through">{{ $stock }}</span>
                            <span class="ml-1 hidden rounded-sm bg-tag px-1 font-semibold group-data-done/demo:inline">{{ $stock - $qty }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>

            <h3 class="mt-5 font-semibold">Contas a receber</h3>
            <p class="mt-1 text-sm text-muted group-data-done/demo:hidden">Nada desta venda ainda.</p>
            <div class="numeric mt-1 hidden rounded-sm bg-tag px-2 py-1.5 text-sm group-data-done/demo:block">
                <p class="flex justify-between gap-2 font-semibold"><span>Venda #1042</span><span>R$ 574,40</span></p>
                <p>Pendente, gerada agora</p>
            </div>
        </div>
    </div>
    <p data-demo-live aria-live="polite" class="sr-only"></p>
</div>
