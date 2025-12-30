<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Composite;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Circuit extends Composite
{
    public function evaluate(mixed $input): Result
    {
        foreach ($this->rules as $rule) {
            $result = $rule->evaluate($input);
            if (!$result->hasPassed) {
                return $result;
            }
        }

        return $result;
    }
}
