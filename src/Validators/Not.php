<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Caio César Tavares <caiotava@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Hussani Oliveira <contato@hussani.com.br>
 * SPDX-FileContributor: Morf <i@morfi.ru>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Torben Brodt <t.brodt@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Not extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        $result = $this->validator->evaluate($input);

        if ($result->isIndeterminate) {
            return $result;
        }

        return $result
            ->withToggledModeAndValidation()
            ->withId($result->id->withPrefix('not'));
    }
}
