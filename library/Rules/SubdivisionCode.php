<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\Subdivisions;

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
    private $subdivisions;

    public function __construct(string $countryCode)
    {
        $subdivisions = new Subdivisions($countryCode);

        $this->countryName = $subdivisions->getCountry();
        $this->subdivisions = array_keys($subdivisions->getSubdivisions());
    }

    /**
     * {@inheritDoc}
     */
    protected function getDataSource(): array
    {
        return $this->subdivisions;
    }
}
