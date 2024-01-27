<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CountryInfo;

use function array_keys;

/**
 * @see http://en.wikipedia.org/wiki/ISO_3166-2
 * @see http://www.geonames.org/countries/
 */
final class SubdivisionCode extends AbstractSearcher
{
    private string $countryName;

    /**
     * @var string[]
     */
    private array $countryInfo;

    public function __construct(string $countryCode)
    {
        $countryInfo = new CountryInfo($countryCode);

        $this->countryName = $countryInfo->getCountry();
        $this->countryInfo = array_keys($countryInfo->getSubdivisions());
    }

    /**
     * @return array<int, string>
     */
    protected function getDataSource(mixed $input = null): array
    {
        return $this->countryInfo;
    }
}
