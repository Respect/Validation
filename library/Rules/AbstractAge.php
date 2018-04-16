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

use Respect\Validation\Helpers\DateTimeHelper;
use function date;
use function date_parse_from_format;
use function is_scalar;
use function strtotime;
use function vsprintf;

/**
 * Abstract class to validate ages.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractAge extends AbstractRule
{
    use DateTimeHelper;

    /**
     * @var int
     */
    private $age;

    /**
     * @var string|null
     */
    private $format;

    /**
     * @var int
     */
    private $baseDate;

    /**
     * Initializes the rule.
     *
     * @param int $age
     * @param string|null $format
     */
    public function __construct(int $age, string $format = null)
    {
        $this->age = $age;
        $this->format = $format;
        $this->baseDate = date('Ymd') - $this->age * 10000;
    }

    /**
     * Should compare the current base date with the given one.
     *
     * The dates are represented as integers in the format "Ymd".
     *
     * @param int $baseDate
     * @param int $givenDate
     *
     * @return bool
     */
    abstract protected function compare(int $baseDate, int $givenDate): bool;

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        if (null === $this->format) {
            return $this->isValidWithoutFormat((string) $input);
        }

        return $this->isValidWithFormat($this->format, (string) $input);
    }

    private function isValidWithoutFormat(string $dateTime): bool
    {
        $timestamp = strtotime($dateTime);
        if (false === $timestamp) {
            return false;
        }

        return $this->compare($this->baseDate, (int) date('Ymd', $timestamp));
    }

    private function isValidWithFormat(string $format, string $dateTime): bool
    {
        if (!$this->isDateTime($format, $dateTime)) {
            return false;
        }

        return $this->compare(
            $this->baseDate,
            (int) vsprintf('%d%02d%02d', date_parse_from_format($format, $dateTime))
        );
    }
}
