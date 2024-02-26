<?php

declare(strict_types=1);

namespace App\Request;

use App\Interfaces\Request\TransactionRequestInterface;
use App\Repository\UserRepository;
use Hyperf\Validation\Request\FormRequest;

class WalletTransactionRequest extends FormRequest implements TransactionRequestInterface
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
                'string'
            ],
            'payee' => [
                'required',
                'string'
            ]
        ];
    }

    public function getTransactionValue(): int
    {
        return (int) ($this->input('value') * 100);
    }

    public function getSenderId(): string
    {
        return $this->input('payer');
    }

    public function getReceiverId(): string
    {
        return $this->input('payee');
    }
}
