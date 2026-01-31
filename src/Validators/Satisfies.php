<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function array_merge;
use function call_user_func_array;
use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be valid',
    '{{subject}} must be invalid',
)]
final class Satisfies extends Simple
{
    /** @var callable */
    private $callback;

    /** @var mixed[] */
    private readonly array $arguments;

    public function __construct(callable $callback, mixed ...$arguments)
    {
        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    public function isValid(mixed $input): bool
    {
        return (bool) call_user_func_array($this->callback, $this->getArguments($input));
    }

    /** @return mixed[] */
    private function getArguments(mixed $input): array
    {
        $arguments = [$input];
        if (count($this->arguments) === 0) {
            return $arguments;
        }

        return array_merge($arguments, $this->arguments);
    }
}
