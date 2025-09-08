<?php

namespace App\Regulator\Rules;

class AbstractRule implements RuleInterface
{
    public function isMetConditions(): bool
    {
        return true;
    }

    public function execAction(): bool
    {
        return true;
    }
}
