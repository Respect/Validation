<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function array_keys;
use function is_scalar;
use function preg_match;
use function preg_replace;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be a valid credit card number',
    '{{name}} must not be a valid credit card number',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} must be a valid {{brand|raw}} credit card number',
    '{{name}} must not be a valid {{brand|raw}} credit card number',
    self::TEMPLATE_BRANDED,
)]
final class CreditCard extends Standard
{
    public const TEMPLATE_BRANDED = '__branded__';
    public const ANY = 'Any';
    public const AMERICAN_EXPRESS = 'American Express';
    public const DINERS_CLUB = 'Diners Club';
    public const DISCOVER = 'Discover';
    public const JCB = 'JCB';
    public const MASTERCARD = 'MasterCard';
    public const VISA = 'Visa';
    public const RUPAY = 'RuPay';

    private const BRAND_REGEX_LIST = [
        self::ANY => '/^[0-9]+$/',
        self::AMERICAN_EXPRESS => '/^3[47]\d{13}$/',
        self::DINERS_CLUB => '/^3(?:0[0-5]|[68]\d)\d{11}$/',
        self::DISCOVER => '/^6(?:011|5\d{2})\d{12}$/',
        self::JCB => '/^(?:2131|1800|35\d{3})\d{11}$/',
        self::MASTERCARD => '/(5[1-5]|2[2-7])\d{14}$/',
        self::VISA => '/^4\d{12}(?:\d{3})?$/',
        self::RUPAY => '/^6(?!011)(?:0[0-9]{14}|52[12][0-9]{12})$/',
    ];

    public function __construct(
        private readonly string $brand = self::ANY
    ) {
        if (!isset(self::BRAND_REGEX_LIST[$brand])) {
            throw new InvalidRuleConstructorException(
                '"%s" is not a valid credit card brand (Available: %s)',
                $brand,
                array_keys(self::BRAND_REGEX_LIST)
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['brand' => $this->brand];
        $template = $this->brand === self::ANY ? self::TEMPLATE_STANDARD : self::TEMPLATE_BRANDED;
        if (!is_scalar($input)) {
            return Result::failed($input, $this, $parameters, $template);
        }

        $filteredInput = (string) preg_replace('/[ .-]/', '', (string) $input);
        if (!(new Luhn())->evaluate($filteredInput)->hasPassed) {
            return Result::failed($input, $this, $parameters, $template);
        }

        return new Result(
            preg_match(self::BRAND_REGEX_LIST[$this->brand], $filteredInput) > 0,
            $input,
            $this,
            $parameters,
            $template
        );
    }
}
