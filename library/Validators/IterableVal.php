<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Devin Torres <devin@devintorres.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Guilherme Siani <guilherme@siani.com.br>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an iterable value',
    '{{subject}} must not be an iterable value',
)]
final class IterableVal extends Simple
{
    use CanValidateIterable;

    public function isValid(mixed $input): bool
    {
        return $this->isIterable($input);
    }
}
