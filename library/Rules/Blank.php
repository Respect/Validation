<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use stdClass;

use function array_filter;
use function is_array;
use function is_numeric;
use function is_string;
use function trim;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be blank',
    '{{subject}} must not be blank',
)]
final class Blank implements Rule
{
    public function evaluate(mixed $input): Result
    {
        return Result::of($this->isBlank($input), $input, $this);
    }

    private function isBlank(mixed $input): bool
    {
        if (is_numeric($input)) {
            return $input == 0;
        }

        if (is_string($input)) {
            $input = trim($input);
        }

        if ($input instanceof stdClass) {
            $input = (array) $input;
        }

        if (is_array($input)) {
            $input = array_filter($input, fn($value) => !$this->isBlank($value));
        }

        return empty($input);
    }
}
