<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use function file_exists;
use function mb_strtoupper;

final class DomainInfo
{
    /**
     * @var mixed[]
     */
    private $data;

    /**
     * @var mixed[]
     */
    private static $runtimeCache = [];

    public function __construct(string $tld)
    {
        $tld = mb_strtoupper($tld);

        if (!isset(static::$runtimeCache[$tld])) {
            $filename = __DIR__ . '/../../data/domain/public-suffix/' . $tld . '.php';
            static::$runtimeCache[$tld] = file_exists($filename) ? require $filename : [];
        }

        $this->data = static::$runtimeCache[$tld];
    }

    /**
     * @return array<string>
     */
    public function getPublicSuffixes(): array
    {
        return $this->data;
    }
}
