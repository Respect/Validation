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
 * @covers \Respect\Validation\Exceptions\MimetypeException
 * @covers \Respect\Validation\Rules\Mimetype
 */
class MimetypeTest extends TestCase
{
    private $filename;

    protected function setUp(): void
    {
        if (defined('HHVM_VERSION')) {
            self::markTestSkipped('If you are a HHVM user, and you are in the mood, please fix it');
        }

        $this->filename = sprintf('%s/validation.txt', sys_get_temp_dir());

        file_put_contents($this->filename, 'File content');
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }

    /**
     * @test
     */
    public function shouldValidateMimetype(): void
    {
        $mimetype = 'plain/text';

        $fileInfoMock = $this
            ->getMockBuilder('finfo')
            ->disableOriginalConstructor()
            ->setMethods(['file'])
            ->getMock();

        $fileInfoMock
            ->expects(self::once())
            ->method('file')
            ->with($this->filename)
            ->will(self::returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        $rule->validate($this->filename);
    }

    /**
     * @test
     */
    public function shouldValidateSplFileInfoMimetype(): void
    {
        $fileInfo = new SplFileInfo($this->filename);
        $mimetype = 'plain/text';

        $fileInfoMock = $this
            ->getMockBuilder('finfo')
            ->disableOriginalConstructor()
            ->setMethods(['file'])
            ->getMock();

        $fileInfoMock
            ->expects(self::once())
            ->method('file')
            ->with($fileInfo->getPathname())
            ->will(self::returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        self::assertTrue($rule->validate($fileInfo));
    }

    /**
     * @test
     */
    public function shouldInvalidateWhenNotStringNorSplFileInfo(): void
    {
        $rule = new Mimetype('application/octet-stream');

        self::assertFalse($rule->validate([__FILE__]));
    }

    /**
     * @test
     */
    public function shouldInvalidateWhenItIsNotAValidFile(): void
    {
        $rule = new Mimetype('application/octet-stream');

        self::assertFalse($rule->validate(__DIR__));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\MimetypeException
     * @expectedExceptionMessageRegExp #".+MimetypeTest.php" must have "application.?/json" mimetype#
     *
     * @test
     */
    public function shouldThrowMimetypeExceptionWhenCheckingValue(): void
    {
        $rule = new Mimetype('application/json');
        $rule->check(__FILE__);
    }
}
