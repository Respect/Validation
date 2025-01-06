<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTimeInterface;
use Respect\Validation\Helpers\CanValidateDateTime;

use function date;
use function is_scalar;
use function strtotime;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class DateTime extends AbstractRule
{
    use CanValidateDateTime;

    /**
     * @var string|null
     */
    private $format;

    /**
     * @var string
     */
    private $sample;

    /**
     * Initializes the rule.
     */
    public function __construct(?string $format = null)
    {
        $this->format = $format;
        $this->sample = date($format ?: 'c', strtotime('2005-12-30 01:02:03'));
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return $this->format === null;
        }

        if (!is_scalar($input)) {
            return false;
        }

        if ($this->format === null) {
            return strtotime((string) $input) !== false;
        }

        return $this->isDateTime($this->format, (string) $input);
    }
}
