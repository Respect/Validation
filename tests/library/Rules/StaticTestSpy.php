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

use InvalidArgumentException;

final class StaticTestSpy extends AbstractRule
{
    public static $constructorCalls = [];
    public static $validateCalls = [];
    public static $assertCalls = [];
    public static $checkCalls = [];
    public static $result = true;

    public function __construct()
    {
        self::$constructorCalls[] = func_get_args();
    }

    public function validate($input)
    {
        self::$validateCalls[] = $input;

        return self::$result;
    }

    public function check($input)
    {
        self::$checkCalls[] = $input;

        if (!$this->validate($input)) {
            throw new InvalidArgumentException('Exception from `StaticTestSpy::check()` method');
        }

        return true;
    }

    public function assert($input)
    {
        self::$assertCalls[] = $input;

        if (!$this->validate($input)) {
            throw new InvalidArgumentException('Exception from `StaticTestSpy::assert()` method');
        }

        return true;
    }

    public static function reset()
    {
        self::$constructorCalls = [];
        self::$validateCalls = [];
        self::$checkCalls = [];
        self::$assertCalls = [];
        self::$result = true;
    }
}
