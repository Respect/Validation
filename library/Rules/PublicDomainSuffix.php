<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;
use Respect\Validation\Helpers\DomainInfo;

use function array_pop;
use function explode;
use function in_array;
use function is_scalar;
use function strtoupper;

final class PublicDomainSuffix extends AbstractRule
{
    use CanValidateUndefined;

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $parts = explode('.', (string) $input);
        $tld = array_pop($parts);

        $domainInfo = new DomainInfo($tld);
        $dataSource = $domainInfo->getPublicSuffixes();
        if ($this->isUndefined($input) && empty($dataSource)) {
            return true;
        }

        return in_array(strtoupper((string) $input), $dataSource, true);
    }
}
