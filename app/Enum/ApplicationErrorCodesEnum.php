<?php

namespace App\Enum;

enum ApplicationErrorCodesEnum: string
{
    case Generic = 'generic';

    case TransactionAuthRequestException = 'transaction_auth_request_exception';
    case InsufficientWalletAmount = 'insufficient_wallet_amount';
    case EnterpriseUserCannotBePayer = 'enterprise_user_cannot_be_payer';
}
