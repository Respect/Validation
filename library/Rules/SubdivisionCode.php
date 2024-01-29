<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;
use Respect\Validation\Helpers\CountryInfo;

use function array_keys;

/**
 * @see http://en.wikipedia.org/wiki/ISO_3166-2
 * @see http://www.geonames.org/countries/
 */
#[Template(
    '{{name}} must be a subdivision code of {{countryName}}',
    '{{name}} must not be a subdivision code of {{countryName}}',
)]
final class SubdivisionCode extends AbstractSearcher
{
    private readonly string $countryName;

    /**
     * @var string[]
     */
    private readonly array $countryInfo;

    public function __construct(string $countryCode)
    {
        $countryInfo = new CountryInfo($countryCode);

        $this->countryName = $countryInfo->getCountry();
        $this->countryInfo = array_keys($countryInfo->getSubdivisions());
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['countryName' => $this->countryName];
    }

    /**
     * @return array<int, string>
     */
    protected function getDataSource(mixed $input = null): array
    {
        return $this->countryInfo;
    }
}
