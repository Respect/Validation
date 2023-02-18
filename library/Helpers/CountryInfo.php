<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Exceptions\ComponentException;

use function file_exists;
use function sprintf;

final class CountryInfo
{
    /**
     * @var mixed[]
     */
    private $data;

    /**
     * @var mixed[]
     */
    private static $runtimeCache = [];

    public function __construct(string $countryCode)
    {
        if (!isset(static::$runtimeCache[$countryCode])) {
            $filename = __DIR__ . '/../../data/iso_3166-2/' . $countryCode . '.php';
            if (!file_exists($filename)) {
                throw new ComponentException(sprintf('"%s" is not a supported country code', $countryCode));
            }
            static::$runtimeCache[$countryCode] = require $filename;
        }

        $this->data = static::$runtimeCache[$countryCode];
    }

    public function getCountry(): string
    {
        return $this->data['country'];
    }

    /**
     * @return string[]
     */
    public function getSubdivisions(): array
    {
        return $this->data['subdivisions'];
    }
}
