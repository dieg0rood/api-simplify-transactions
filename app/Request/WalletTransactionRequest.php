<?php

declare(strict_types=1);

namespace App\Request;

use App\Repository\UserRepository;
use App\Repository\WalletRepository;
use Hyperf\Validation\Request\FormRequest;

class WalletTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'value' => [
                'required',
                'numeric',
                'min:100'
            ],
            'payer' => [
                'required',
                'string',
                'in:' . join(',', UserRepository::onlyPayers()->pluck('id'))
            ],
            'payee' => [
                'required',
                'string'
            ]
        ];
    }

    public function getTransactionValue(): int
    {
        return $this->input('value');
    }

    public function getSenderId(): int
    {
        return $this->input('payer');
    }

    public function getReceiverId(): int
    {
        return $this->input('payee');
    }
}
