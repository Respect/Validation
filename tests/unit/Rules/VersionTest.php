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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Version
 * @covers \Respect\Validation\Exceptions\VersionException
 */
class VersionTest extends TestCase
{
    /**
     * @dataProvider providerForValidVersion
     */
    public function testValidVersionShouldReturnTrue($input): void
    {
        $rule = new Version();
        self::assertTrue($rule->__invoke($input));
        self::assertTrue($rule->assert($input));
        self::assertTrue($rule->check($input));
    }

    /**
     * @dataProvider providerForInvalidVersion
     * @expectedException \Respect\Validation\Exceptions\VersionException
     */
    public function testInvalidVersionShouldThrowException($input): void
    {
        $rule = new Version();
        self::assertFalse($rule->__invoke($input));
        self::assertFalse($rule->assert($input));
    }

    public function providerForValidVersion()
    {
        return [
            ['1.0.0'],
            ['1.0.0-alpha'],
            ['1.0.0-alpha.1'],
            ['1.0.0-0.3.7'],
            ['1.0.0-x.7.z.92'],
            ['1.3.7+build.2.b8f12d7'],
            ['1.3.7-rc.1'],
        ];
    }

    public function providerForInvalidVersion()
    {
        return [
            [''],
            ['1.3.7--'],
            ['1.3.7++'],
            ['foo'],
            ['1.2.3.4'],
            ['1.2.3.4-beta'],
            ['beta'],
        ];
    }
}
