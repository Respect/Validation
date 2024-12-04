<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

use function array_merge;
use function call_user_func_array;
use function count;

#[Template(
    '{{name}} must be valid',
    '{{name}} must be invalid',
)]
final class Callback extends Simple
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @var mixed[]
     */
    private readonly array $arguments;

    public function __construct(callable $callback, mixed ...$arguments)
    {
        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    protected function isValid(mixed $input): bool
    {
        return (bool) call_user_func_array($this->callback, $this->getArguments($input));
    }

    /**
     * @return mixed[]
     */
    private function getArguments(mixed $input): array
    {
        $arguments = [$input];
        if (count($this->arguments) === 0) {
            return $arguments;
        }

        return array_merge($arguments, $this->arguments);
    }
}
