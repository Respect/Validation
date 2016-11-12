<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

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
final class Date implements Rule
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
        if (isset(self::EXCEPTIONAL_FORMATS[$format])) {
            $format = self::EXCEPTIONAL_FORMATS[$format];
        }

        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        if ($input instanceof DateTimeInterface) {
            return new Result($this->format === null, $input, $this, array_filter(['format' => $this->format]));
        }

        $scalarValResult = (new ScalarVal())->validate($input);
        if (!$scalarValResult->isValid()) {
            return new Result(false, $input, $this, [], $scalarValResult);
        }

        if ($this->format === null) {
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
        $info = date_parse_from_format($format, $input);
        $isValid = $info['error_count'] === 0 && $info['warning_count'] === 0;

        return new Result($isValid, $input, $this, ['format' => $format]);
    }
}
