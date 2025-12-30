<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\KeyRelated;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class KeyOptional extends Wrapper implements KeyRelated
{
    public function __construct(
        private readonly int|string $key,
        Rule $rule,
    ) {
        parent::__construct($rule);
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function evaluate(mixed $input): Result
    {
        $keyExistsResult = (new KeyExists($this->key))->evaluate($input);
        if (!$keyExistsResult->hasPassed) {
            return $keyExistsResult->withNameFrom($this->rule)->withToggledModeAndValidation();
        }

        return (new Key($this->key, $this->rule))->evaluate($input);
    }
}
