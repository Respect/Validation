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
use function array_keys;
use function implode;
use function is_scalar;
use function preg_match;
use function preg_replace;
use function sprintf;

/**
 * Validates whether the input is a credit card number.
 *
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 * @author Andy Snell <andysnell@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CreditCard extends AbstractRule
{
    public const ANY = 'Any';

    public const AMERICAN_EXPRESS = 'American Express';

    public const DINERS_CLUB = 'Diners Club';

    public const DISCOVER = 'Discover';

    public const JCB = 'JCB';

    public const MASTERCARD = 'MasterCard';

    public const VISA = 'Visa';

    private const BRAND_REGEX_LIST = [
        self::ANY => '/^[0-9]+$/',
        self::AMERICAN_EXPRESS => '/^3[47]\d{13}$/',
        self::DINERS_CLUB => '/^3(?:0[0-5]|[68]\d)\d{11}$/',
        self::DISCOVER => '/^6(?:011|5\d{2})\d{12}$/',
        self::JCB => '/^(?:2131|1800|35\d{3})\d{11}$/',
        self::MASTERCARD => '/(5[1-5]|2[2-7])\d{14}$/',
        self::VISA => '/^4\d{12}(?:\d{3})?$/',
    ];

    /**
     * @var string
     */
    private $brand;

    /**
     * Initializes the rule.
     *
     * @throws ComponentException
     */
    public function __construct(string $brand = self::ANY)
    {
        if (!isset(self::BRAND_REGEX_LIST[$brand])) {
            throw new ComponentException(
                sprintf(
                    '"%s" is not a valid credit card brand (Available: %s)',
                    $brand,
                    implode(', ', array_keys(self::BRAND_REGEX_LIST))
                )
            );
        }

        $this->brand = $brand;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $input = preg_replace('/[ .-]/', '', (string) $input);
        if (!(new Luhn())->validate($input)) {
            return false;
        }

        return preg_match(self::BRAND_REGEX_LIST[$this->brand], $input) > 0;
    }
}
