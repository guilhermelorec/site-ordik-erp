<?php

namespace App\Http\Requests;

use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Guarda só os dígitos do WhatsApp: "(11) 91234-5678" -> "11912345678".
        $this->merge(['whatsapp' => preg_replace('/\D/', '', (string) $this->input('whatsapp'))]);
    }

    // O formulário fica no fim das páginas: o visitante precisa voltar direto aos erros.
    protected function getRedirectUrl(): string
    {
        return url()->previous().'#pedido';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'company' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'whatsapp' => ['required', 'digits_between:10,13'],
            'segment' => ['required', Rule::in(Lead::SEGMENTS)],
            'branches' => ['required', Rule::in(Lead::BRANCHES)],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'company' => 'empresa',
            'email' => 'e-mail',
            'whatsapp' => 'WhatsApp',
            'segment' => 'segmento',
            'branches' => 'número de unidades',
            'message' => 'mensagem',
        ];
    }
}
