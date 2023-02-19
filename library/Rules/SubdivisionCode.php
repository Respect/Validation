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
 * Validates country subdivision codes according to ISO 3166-2.
 *
 * @see http://en.wikipedia.org/wiki/ISO_3166-2
 * @see http://www.geonames.org/countries/
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class SubdivisionCode extends AbstractSearcher
{
    /**
     * @var string
     */
    private $countryName;

    /**
     * @var string[]
     */
    private $countryInfo;

    public function __construct(string $countryCode)
    {
        $countryInfo = new CountryInfo($countryCode);

        $this->countryName = $countryInfo->getCountry();
        $this->countryInfo = array_keys($countryInfo->getSubdivisions());
    }

    /**
     * {@inheritDoc}
     */
    protected function getDataSource($input = null): array
    {
        return $this->countryInfo;
    }
}
