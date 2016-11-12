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

use DateTimeInterface;
use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates if input is a date.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class DateTime implements Rule
{
    /**
     * @var string
     */
    private $format;

    const EXCEPTIONAL_FORMATS = [
        'c' => 'Y-m-d\TH:i:sP',
        'r' => 'D, d M Y H:i:s O',
    ];

    public function __construct(string $format = null)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        if ($input instanceof DateTimeInterface) {
            return new Result(null === $this->format, $input, $this, array_filter(['format' => $this->format]));
        }

        $scalarValResult = (new ScalarVal())->apply($input);
        if (!$scalarValResult->isValid()) {
            return new Result(false, $input, $this, [], $scalarValResult);
        }

        if (null === $this->format) {
            return $this->validateWithoutFormat($input);
        }

        return $this->validateWithFormat($input, $this->format);
    }

    private function validateWithoutFormat($input): Result
    {
        return new Result(false !== strtotime($input), $input, $this);
    }

    private function validateWithFormat($input, string $format): Result
    {
        if (isset(self::EXCEPTIONAL_FORMATS[$format])) {
            $format = self::EXCEPTIONAL_FORMATS[$format];
        }

        $info = date_parse_from_format($format, (string) $input);
        $isValid = 0 === $info['error_count'] && 0 === $info['warning_count'];

        return new Result($isValid, $input, $this, ['format' => $format]);
    }
}
