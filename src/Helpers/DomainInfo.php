<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use function file_exists;
use function mb_strtoupper;

final class DomainInfo
{
    /** @var mixed[] */
    private readonly array $data;

    /** @var mixed[] */
    private static array $runtimeCache = [];

    public function __construct(string $tld)
    {
        $tld = mb_strtoupper($tld);

        if (!isset(static::$runtimeCache[$tld])) {
            $filename = __DIR__ . '/../../data/domain/public-suffix/' . $tld . '.php';
            static::$runtimeCache[$tld] = file_exists($filename) ? require $filename : [];
        }

        $this->data = static::$runtimeCache[$tld];
    }

    /** @return array<string> */
    public function getPublicSuffixes(): array
    {
        return $this->data;
    }
}
