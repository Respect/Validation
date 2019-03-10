<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use OutOfBoundsException;
use Respect\Validation\Exceptions\ComponentException;
use Sokil\IsoCodes\Database\Subdivisions\Subdivision;
use Sokil\IsoCodes\IsoCodesFactory;
use Throwable;
use function array_map;
use function sprintf;
use function substr;

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

    /**
     * @throws ComponentException
     */
    public function __construct(string $countryCode)
    {
        try {
            $factory = new IsoCodesFactory();
            $this->subdivisions = $this->getSubdivisions($countryCode, $factory);
            $this->countryName = $this->getCountryName($countryCode, $factory);
        } catch (Throwable $exception) {
            throw new ComponentException(
                sprintf('"%s" is not a supported country code', $countryCode),
                0,
                $exception
            );
        }
    }

    /**
     * @return mixed[]
     */
    protected function getDataSource(): array
    {
        return $this->subdivisions;
    }

    private function getCountryName(string $countryCode, IsoCodesFactory $factory): string
    {
        $country = $factory->getCountries()->getByAlpha2($countryCode);
        if ($country == null) {
            throw new OutOfBoundsException(sprintf('Could not find country "%s"', $countryCode));
        }

        return $country->getName();
    }

    /**
     * @return mixed[]
     */
    private function getSubdivisions(string $countryCode, IsoCodesFactory $factory): array
    {
        return array_map(
            static function (Subdivision $subdivision): string {
                return substr($subdivision->getCode(), 3);
            },
            (array) $factory->getSubdivisions()->getAllByCountryCode($countryCode)
        );
    }
}
