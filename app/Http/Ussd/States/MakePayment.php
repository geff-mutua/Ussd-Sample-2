<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error;

class MakePayment extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Make Payment')
        ->lineBreak(2)
        ->line('Select an option')
        ->listing([
            'Pay Bill',
            'Check Bills']
            )
        ->lineBreak(2)
        ->line('#. Back')
        ->line('Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1',PayBill::class)
        ->any(Error::class);
    }
}
