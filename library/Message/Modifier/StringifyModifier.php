<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Modifier;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Modifier;

use function print_r;
use function sprintf;

final readonly class StringifyModifier implements Modifier
{
    public function __construct(
        private Stringifier $stringifier,
    ) {
    }

    public function modify(mixed $value, string|null $pipe): string
    {
        if ($pipe !== null) {
            throw new ComponentException(sprintf(
                'StringifyModifier only accepts null as  pipe but "%s" was given.',
                $pipe,
            ));
        }

        return $this->stringifier->stringify($value, 0) ?? print_r($value, true);
    }
}
