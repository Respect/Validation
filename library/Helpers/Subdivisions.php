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

namespace Respect\Validation\Helpers;

use Respect\Validation\Exceptions\ComponentException;
use function file_exists;
use function file_get_contents;
use function json_decode;
use function sprintf;

/**
 * Helper to fetch the designated subdivision codes.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class Subdivisions
{
    /**
     * @var mixed[]
     */
    private static $data;

    /**
     * @var string
     */
    private $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = $countryCode;

        if (isset(self::$data[$countryCode])) {
            return;
        }

        $filename = __DIR__.'/../../data/iso_3166-2/'.$countryCode.'.json';
        if (!file_exists($filename)) {
            throw new ComponentException(sprintf('"%s" is not a supported country code', $countryCode));
        }
        self::$data[$countryCode] = (array) json_decode(file_get_contents($filename), true);
    }

    public function getCountry(): string
    {
        return self::$data[$this->countryCode]['country'];
    }

    /**
     * @return string[]
     */
    public function getSubdivisions(): array
    {
        return self::$data[$this->countryCode]['subdivisions'];
    }
}
