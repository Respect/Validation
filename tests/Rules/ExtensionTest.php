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
class ExtensionTest extends PHPUnit_Framework_TestCase
{
    public function providerValidExtension()
    {
        return array(
            array('filename.txt', 'txt'),
            array('filename.jpg', 'jpg'),
            array('filename.inc.php', 'php'),
            array('filename.foo.bar.bz2', 'bz2'),
        );
    }

    /**
     * @dataProvider providerValidExtension
     */
    public function testShouldValidateExtension($filename, $extension)
    {
        $rule = new Extension($extension);

        $this->assertTrue($rule->validate($filename));
    }

    public function testShouldAcceptSplFileInfo()
    {
        $fileInfo = new SplFileInfo(__FILE__);

        $rule = new Extension('php');

        $this->assertTrue($rule->validate($fileInfo));
    }

    public function testShouldInvalidWhenNotStringNorSplFileInfo()
    {
        $nonFile = array(__FILE__);

        $rule = new Extension('php');

        $this->assertFalse($rule->validate($nonFile));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ExtensionException
     * @expectedExceptionMessage "filename.jpg" must have "png" extension
     */
    public function testShouldThrowExtensionExceptionWhenCheckingValue()
    {
        $rule = new Extension('png');
        $rule->check('filename.jpg');
    }
}
