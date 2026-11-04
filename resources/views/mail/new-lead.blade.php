<x-mail::message>
# Novo pedido de demonstração

<x-mail::table>
| | |
|:--|:--|
| **Nome** | {{ $lead->name }} |
| **Empresa** | {{ $lead->company }} |
| **E-mail** | {{ $lead->email }} |
| **WhatsApp** | {{ $lead->whatsapp }} |
| **Segmento** | {{ $lead->segment }} |
| **Unidades** | {{ $lead->branches }} |
| **Página** | {{ $lead->source ?? 'Não informada' }} |
| **Recebido em** | {{ $lead->created_at->format('d/m/Y H:i') }} |
</x-mail::table>

@if ($lead->message)
**Mensagem**

{{ $lead->message }}
@endif

<x-mail::button :url="url('/admin/leads')">
Ver no painel
</x-mail::button>
</x-mail::message>
