<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Error extends State
{
    protected $action = self::PROMPT;
    protected function beforeRendering(): void
    {
        $this->menu->text('Invalid Input');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
