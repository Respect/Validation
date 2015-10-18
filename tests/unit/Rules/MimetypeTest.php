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

use PHPUnit_Framework_TestCase;
use SplFileInfo;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @group  rule
 * @covers Respect\Validation\Rules\Mimetype
 * @covers Respect\Validation\Exceptions\MimetypeException
 */
class MimetypeTest extends PHPUnit_Framework_TestCase
{
    private $filename;

    protected function setUp()
    {
        $this->filename = sprintf('%s/validation.txt', sys_get_temp_dir());

        file_put_contents($this->filename, 'File content');
    }

    protected function tearDown()
    {
        unlink($this->filename);
    }

    public function testShouldValidateMimetype()
    {
        $mimetype = 'plain/text';

        $fileInfoMock = $this
            ->getMockBuilder('finfo')
            ->disableOriginalConstructor()
            ->setMethods(['file'])
            ->getMock();

        $fileInfoMock
            ->expects($this->once())
            ->method('file')
            ->with($this->filename)
            ->will($this->returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        $rule->validate($this->filename);
    }

    public function testShouldValidateSplFileInfoMimetype()
    {
        $fileInfo = new SplFileInfo($this->filename);
        $mimetype = 'plain/text';

        $fileInfoMock = $this
            ->getMockBuilder('finfo')
            ->disableOriginalConstructor()
            ->setMethods(['file'])
            ->getMock();

        $fileInfoMock
            ->expects($this->once())
            ->method('file')
            ->with($fileInfo->getPathname())
            ->will($this->returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        $this->assertTrue($rule->validate($fileInfo));
    }

    public function testShouldInvalidateWhenNotStringNorSplFileInfo()
    {
        $rule = new Mimetype('application/octet-stream');

        $this->assertFalse($rule->validate([__FILE__]));
    }

    public function testShouldInvalidateWhenItIsNotAValidFile()
    {
        $rule = new Mimetype('application/octet-stream');

        $this->assertFalse($rule->validate(__DIR__));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\MimetypeException
     * @expectedExceptionMessageRegExp #".+MimetypeTest.php" must have "application.?/json" mimetype#
     */
    public function testShouldThrowMimetypeExceptionWhenCheckingValue()
    {
        $rule = new Mimetype('application/json');
        $rule->check(__FILE__);
    }
}
