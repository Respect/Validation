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
 * @covers \Respect\Validation\Exceptions\ExtensionException
 * @covers \Respect\Validation\Rules\Extension
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
     *
     * @test
     */
    public function shouldValidateExtension($filename, $extension): void
    {
        $rule = new Extension($extension);

        self::assertTrue($rule->isValid($filename));
    }

    /**
     * @test
     */
    public function shouldAcceptSplFileInfo(): void
    {
        $fileInfo = new SplFileInfo(__FILE__);

        $rule = new Extension('php');

        self::assertTrue($rule->isValid($fileInfo));
    }

    /**
     * @test
     */
    public function shouldInvalidWhenNotStringNorSplFileInfo(): void
    {
        $nonFile = [__FILE__];

        $rule = new Extension('php');

        self::assertFalse($rule->isValid($nonFile));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ExtensionException
     * @expectedExceptionMessage "filename.jpg" must have "png" extension
     *
     * @test
     */
    public function shouldThrowExtensionExceptionWhenCheckingValue(): void
    {
        $rule = new Extension('png');
        $rule->check('filename.jpg');
    }
}
