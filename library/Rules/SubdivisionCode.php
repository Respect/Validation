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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\Data\Data;
use Respect\Validation\Helpers\Data\DataException;
use function sprintf;

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
        $data = $this->getDataFromCountryCode($countryCode);

        try {
            $this->countryName = $data->get('country_name');
            $this->subdivisions = $data->get('subdivisions', 'array_keys');
        } catch (DataException $e) {
            throw new ComponentException(sprintf('Missing data for the following country code "%s".', $countryCode));
        }
    }

    /**
     * @return mixed[]
     */
    protected function getDataSource(): array
    {
        return $this->subdivisions;
    }

    /**
     *
     * @throws ComponentException
     */
    private function getDataFromCountryCode(string $countryCode): Data
    {
        $data = new Data();
        $filename = sprintf('subdivision-%s.json', $countryCode);

        try {
            $data->load($filename);
        } catch (DataException $e) {
            throw new ComponentException(sprintf('"%s" is not a supported country code', $countryCode));
        }

        return $data;
    }
}
