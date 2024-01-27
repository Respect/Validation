<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_merge;
use function call_user_func_array;
use function count;

final class Callback extends AbstractRule
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @var mixed[]
     */
    private array $arguments;

    public function __construct(callable $callback, mixed ...$arguments)
    {
        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    public function validate(mixed $input): bool
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
