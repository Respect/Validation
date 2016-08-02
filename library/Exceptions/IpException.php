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

class IpException extends ValidationException
{
    const STANDARD = 0;
    const NETWORK_RANGE = 1;

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be an IP address',
            self::NETWORK_RANGE => '{{name}} must be an IP address in the {{range}} range',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be an IP address',
            self::NETWORK_RANGE => '{{name}} must not be an IP address in the {{range}} range',
        ],
    ];

    public function configure($name, array $params = [])
    {
        if ($params['networkRange']) {
            $range = $params['networkRange'];
            $message = $range['min'];

            if (isset($range['max'])) {
                $message .= '-'.$range['max'];
            } else {
                $message .= '/'.long2ip((int) $range['mask']);
            }

            $params['range'] = $message;
        }

        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        if (!$this->getParam('networkRange')) {
            return static::STANDARD;
        } else {
            return static::NETWORK_RANGE;
        }
    }
}
