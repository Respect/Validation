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

class CreditCard extends AbstractRule
{
    const AMERICAN_EXPRESS = 'American Express';
    const DINERS_CLUB = 'Diners Club';
    const DISCOVER = 'Discover';
    const JCB = 'JCB';
    const MASTERCARD = 'MasterCard';
    const VISA = 'Visa';

    /**
     * @var string
     */
    public $brand;

    /**
     * @var array
     */
    private $brands = [
        self::AMERICAN_EXPRESS => '/^3[47]\d{13}$/',
        self::DINERS_CLUB => '/^3(?:0[0-5]|[68]\d)\d{11}$/',
        self::DISCOVER => '/^6(?:011|5\d{2})\d{12}$/',
        self::JCB => '/^(?:2131|1800|35\d{3})\d{11}$/',
        self::MASTERCARD => '/(5[1-5]|2[2-7])\d{14}$/',
        self::VISA => '/^4\d{12}(?:\d{3})?$/',
    ];

    /**
     * @param string $brand Optional credit card brand
     */
    public function __construct($brand = null)
    {
        if (null !== $brand && !isset($this->brands[$brand])) {
            $brands = implode(', ', array_keys($this->brands));
            $message = sprintf('"%s" is not a valid credit card brand (Available: %s).', $brand, $brands);
            throw new ComponentException($message);
        }

        $this->brand = $brand;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        $input = preg_replace('([^0-9])', '', $input);

        if (empty($input)) {
            return false;
        }

        if (!(new Luhn())->validate($input)) {
            return false;
        }

        return $this->verifyBrand($input);
    }

    /**
     * Returns whether the input matches the defined credit card brand or not.
     *
     * @param string $input
     *
     * @return bool
     */
    private function verifyBrand($input)
    {
        if (null === $this->brand) {
            return true;
        }

        $pattern = $this->brands[$this->brand];

        return preg_match($pattern, $input) > 0;
    }
}
