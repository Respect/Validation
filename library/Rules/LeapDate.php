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
use function is_string;

/**
 * Validates if a date is leap.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <jayson.reis@sabbre.com.br>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapDate extends AbstractRule
{
    /**
     * @var string
     */
    private $format = null;

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
        if (is_string($input)) {
            $date = DateTimeImmutable::createFromFormat($this->format, $input);
        } elseif ($input instanceof DateTimeInterface) {
            $date = $input;
        } else {
            return false;
        }

        // Dates that aren't leap will aways be rounded
        return '02-29' == $date->format('m-d');
    }
}
