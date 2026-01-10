<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Helpers\DataLoader;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function array_pop;
use function explode;
use function in_array;
use function is_scalar;
use function mb_strtoupper;
use function strtoupper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a public domain suffix',
    '{{subject}} must not be a public domain suffix',
)]
final class PublicDomainSuffix extends Simple
{
    use CanValidateUndefined;

    public function isValid(mixed $input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $parts = explode('.', (string) $input);
        $tld = array_pop($parts);

        $dataSource = DataLoader::load('domain/public-suffix/' . mb_strtoupper($tld) . '.php');
        if ($this->isUndefined($input) && $dataSource === []) {
            return true;
        }

        return in_array(strtoupper((string) $input), $dataSource, true);
    }
}
