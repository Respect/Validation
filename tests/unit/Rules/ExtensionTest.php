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
use SplFileInfo;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @group  rule
 * @covers \Respect\Validation\Rules\Extension
 * @covers \Respect\Validation\Exceptions\ExtensionException
 */
class ExtensionTest extends TestCase
{
    public function providerValidExtension()
    {
        return [
            ['filename.txt', 'txt'],
            ['filename.jpg', 'jpg'],
            ['filename.inc.php', 'php'],
            ['filename.foo.bar.bz2', 'bz2'],
        ];
    }

    /**
     * @dataProvider providerValidExtension
     */
    public function testShouldValidateExtension($filename, $extension): void
    {
        $rule = new Extension($extension);

        self::assertTrue($rule->validate($filename));
    }

    public function testShouldAcceptSplFileInfo(): void
    {
        $fileInfo = new SplFileInfo(__FILE__);

        $rule = new Extension('php');

        self::assertTrue($rule->validate($fileInfo));
    }

    public function testShouldInvalidWhenNotStringNorSplFileInfo(): void
    {
        $nonFile = [__FILE__];

        $rule = new Extension('php');

        self::assertFalse($rule->validate($nonFile));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ExtensionException
     * @expectedExceptionMessage "filename.jpg" must have "png" extension
     */
    public function testShouldThrowExtensionExceptionWhenCheckingValue(): void
    {
        $rule = new Extension('png');
        $rule->check('filename.jpg');
    }
}
