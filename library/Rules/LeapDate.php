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
     *
     * @param string $format
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof DateTimeInterface) {
            return '02-29' === $input->format('m-d');
        }

        if (is_scalar($input)) {
            return $this->validate(DateTimeImmutable::createFromFormat($this->format, (string) $input));
        }

        return false;
    }
}
