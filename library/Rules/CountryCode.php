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

use Respect\Validation\Exceptions\ComponentException;
use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\TranslationDriver\DummyDriver;

use function array_keys;
use function implode;
use function is_int;
use function is_string;
use function sprintf;

/**
 * Validates whether the input is a country code in ISO 3166-1 standard.
 *
 * This rule supports the three sets of country codes (alpha-2, alpha-3, and numeric).
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Felipe Martins <me@fefas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CountryCode extends AbstractRule
{
    /**
     * The ISO representation of a country code.
     */
    public const ALPHA2 = 'alpha-2';

    /**
     * The ISO3 representation of a country code.
     */
    public const ALPHA3 = 'alpha-3';

    /**
     * The ISO-number representation of a country code.
     */
    public const NUMERIC = 'numeric';

    /**
     * Position of the indexes of each set in the list of country codes.
     */
    private const SET_INDEXES = [
        self::ALPHA2 => 0,
        self::ALPHA3 => 1,
        self::NUMERIC => 2,
    ];

    /**
     * @var string
     */
    private $set;

    /**
     * @var IsoCodesFactory
     */
    private $factory;

    /**
     * Initializes the rule.
     *
     * @throws ComponentException If $set is not a valid set
     */
    public function __construct(string $set = self::ALPHA2)
    {
        if (!isset(self::SET_INDEXES[$set])) {
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid set for ISO 3166-1 (Available: %s)',
                    $set,
                    implode(', ', array_keys(self::SET_INDEXES))
                )
            );
        }

        $this->set = $set;
        $this->factory = new IsoCodesFactory(null, new DummyDriver());
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input) && !is_int($input)) {
            return false;
        }

        $countries = $this->factory->getCountries();
        if ($this->set === self::ALPHA2) {
            return $countries->getByAlpha2((string) $input) !== null;
        }

        if ($this->set === self::ALPHA3) {
            return $countries->getByAlpha3((string) $input) !== null;
        }

        return $countries->getByNumericCode($input) !== null;
    }
}
