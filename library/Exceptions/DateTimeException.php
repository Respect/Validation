<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

class DateTimeException extends ValidationException
{
    const FORMAT = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid date/time',
            self::FORMAT => '{{name}} must be a valid date/time. Sample format: {{format}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid date/time',
            self::FORMAT => '{{name}} must not be a valid date/time in the format {{format}}',
        ],
    ];

    public function configure($name, array $params = [])
    {
        $params['format'] = date(
            $params['format'],
            strtotime('2005-12-30 01:02:03')
        );

        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        return $this->getParam('format') ? static::FORMAT : static::STANDARD;
    }
}
