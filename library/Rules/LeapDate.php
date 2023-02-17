<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTimeImmutable;
use DateTimeInterface;

use function is_scalar;

/**
 * Validates if a date is leap.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapDate extends AbstractRule
{
    /**
     * @var string
     */
    private $format;

    /**
     * Initializes the rule with the expected format.
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return $input->format('m-d') === '02-29';
        }

        if (is_scalar($input)) {
            return $this->validate(DateTimeImmutable::createFromFormat($this->format, (string) $input));
        }

        return false;
    }
}
