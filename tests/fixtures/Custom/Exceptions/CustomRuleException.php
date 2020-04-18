<?php
declare(strict_types=1);

namespace Custom\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class CustomRuleException
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
final class CustomRuleException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'INVALID',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'INVALID',
        ],
    ];
}