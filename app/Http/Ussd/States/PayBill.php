<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error;
use App\Http\Ussd\States\Welcome;

class PayBill extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('PayBill')
        ->lineBreak(2)
        ->line('Select an option')
        ->listing(['Exit']
            )
        ->lineBreak(2)
        ->line('#. Back')
        ->line('Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1',Welcome::class)
                        ->equal('#',Welcome::class)
        ->any(Error::class);
    }
}
