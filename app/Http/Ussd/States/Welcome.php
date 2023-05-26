<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;
use App\Http\Ussd\States\Error;
use App\Http\Ussd\States\MakePayment;

class Welcome extends State
{
    protected $action = self::PROMPT;
    protected function beforeRendering(): void
    {
         $this->menu->text('Welcome To Laravel Ussd')
            ->lineBreak(2)
            ->line('Select an option')
            ->listing([
                'Buy Airtime',
                'Buy Data',
                'Pay Bills',
                'Invest.']);
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1',MakePayment::class)
                       ->any(Error::class);
    }
}
