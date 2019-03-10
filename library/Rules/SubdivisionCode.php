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
use function array_keys;
use function file_exists;
use function file_get_contents;
use function json_decode;
use function sprintf;

/**
 * Validates country subdivision codes according to ISO 3166-2.
 *
 * @see http://en.wikipedia.org/wiki/ISO_3166-2
 * @see http://www.geonames.org/countries/
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
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

        $this->countryName = $data['country_name'];
        $this->subdivisions = array_keys($data['subdivisions']);
    }

    /**
     * @return mixed[]
     */
    protected function getDataSource(): array
    {
        return $this->subdivisions;
    }

    /**
     * @return string[]
     *
     * @throws ComponentException
     */
    private function getDataFromCountryCode(string $countryCode): array
    {
        $filename = sprintf('%s/../../data/subdivision-%s.json', __DIR__, $countryCode);
        if (!file_exists($filename)) {
            throw new ComponentException(sprintf('"%s" is not a supported country code', $countryCode));
        }

        return json_decode(file_get_contents($filename), true);
    }
}
