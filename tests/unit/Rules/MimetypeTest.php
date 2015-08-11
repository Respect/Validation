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
 */
class MimetypeTest extends PHPUnit_Framework_TestCase
{
    public function testShouldValidateMimetype()
    {
        $filename = 'filename.txt';
        $mimetype = 'plain/text';

        $fileInfoMock = $this
            ->getMockBuilder('finfo')
            ->disableOriginalConstructor()
            ->setMethods(array('file'))
            ->getMock();

        $fileInfoMock
            ->expects($this->once())
            ->method('file')
            ->with($filename)
            ->will($this->returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        $this->assertTrue($rule->validate($filename));
    }

    public function testShouldValidateSplFileInfoMimetype()
    {
        $fileInfo = new SplFileInfo('filename.png');
        $mimetype = 'image/png';

        $fileInfoMock = $this
            ->getMockBuilder('finfo')
            ->disableOriginalConstructor()
            ->setMethods(array('file'))
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

        $this->assertFalse($rule->validate(array(__FILE__)));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\MimetypeException
     * @expectedExceptionMessage MimetypeTest.php" must have "application/json" mimetype
     */
    public function testShouldThowsMimetypeExceptionWhenCheckingValue()
    {
        $rule = new Mimetype('application/json');
        $rule->check(__FILE__);
    }
}
