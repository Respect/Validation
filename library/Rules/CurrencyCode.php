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

use function implode;
use function in_array;
use function is_int;
use function is_string;
use function sprintf;

/**
 * Validates currency codes in ISO 4217.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Justin Hook <justinhook88@yahoo.co.uk>
 * @author Tim Strijdhorst <tstrijdhorst@users.noreply.github.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CurrencyCode extends AbstractRule
{
    public const ALPHA3 = 'alpha-3';
    public const NUMERIC = 'numeric';

    /**
     * @var string
     */
    private $set;

    /**
     * @var IsoCodesFactory
     */
    private $factory;

    public function __construct(string $set = self::ALPHA3)
    {
        if (!in_array($set, [self::ALPHA3, self::NUMERIC])) {
            throw new ComponentException(sprintf(
                '"%s" is not a valid set for ISO 4217 (Available: %s)',
                $set,
                implode(', ', [self::ALPHA3, self::NUMERIC])
            ));
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

        $currencies = $this->factory->getCurrencies();
        if ($this->set === self::ALPHA3) {
            return $currencies->getByLetterCode((string) $input) !== null;
        }

        return $currencies->getByNumericCode($input) !== null;
    }
}
