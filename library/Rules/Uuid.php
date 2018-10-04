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

use Respect\Validation\Exceptions\ComponentException;
use function is_scalar;
use function preg_match;

/**
 * This class validates UUIDs.
 *
 * Henrique Moody <henriquemoody@gmail.com>
 * Michael Weimann <mail@michael-weimann.eu>
 */
class Uuid extends AbstractRule
{
    public const VERSION_ALL = '[1-5]';
    public const VERSION_1 = '1';
    public const VERSION_2 = '2';
    public const VERSION_3 = '3';
    public const VERSION_4 = '4';
    public const VERSION_5 = '5';

    public const VERSIONS = [
        self::VERSION_ALL,
        self::VERSION_1,
        self::VERSION_2,
        self::VERSION_3,
        self::VERSION_4,
        self::VERSION_5,
    ];

    /**
     * Uuid regex pattern with sprint version placeholder.
     */
    private const PATTERN = '/^[0-9a-f]{8}-[0-9a-f]{4}-%s[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    /**
     * The UUID version to validate for.
     *
     * string
     */
    private $version;

    /**
     * Uuid constructor.
     *
     * @param string $version use one of the Uuid class constants
     *
     * @throws ComponentException
     */
    public function __construct(string $version = self::VERSION_ALL)
    {
        if (false === in_array($version, self::VERSIONS)) {
            $message = sprintf('invalid version %s given, possible: %s', $version, join(', ', self::VERSIONS));
            throw new ComponentException($message);
        }

        $this->version = $version;
    }

    /**
     * Validates whether input is an UUID.
     *
     * @param mixed $input the value to test
     *
     * @return bool
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $pattern = sprintf(self::PATTERN, $this->version);

        return preg_match($pattern, (string) $input) > 0;
    }
}
