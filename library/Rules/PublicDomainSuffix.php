<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;
use Respect\Validation\Helpers\DomainInfo;

use function array_pop;
use function explode;

#[Template(
    '{{name}} must be a public domain suffix',
    '{{name}} must be a public domain suffix',
)]
final class PublicDomainSuffix extends AbstractSearcher
{
    /**
     * @return string[]
     */
    protected function getDataSource(mixed $input = null): array
    {
        $parts = explode('.', $input);
        $tld = array_pop($parts);

        return (new DomainInfo($tld))->getPublicSuffixes();
    }
}
