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

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;
use SplFileInfo;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Exists
 * @covers Respect\Validation\Exceptions\ExistsException
 */
class ExistsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider fileProvider
     * @covers Respect\Validation\Rules\Exists::validate
     */
    public function testExistentFileShouldReturnTrue($file)
    {
        $rule = new Exists();
        $this->assertTrue($rule->validate($file->url()));
    }

    /**
     * @covers Respect\Validation\Rules\Exists::validate
     */
    public function testNonExistentFileShouldReturnFalse()
    {
        $rule = new Exists();
        $this->assertFalse($rule->validate('/path/of/a/non-existent/file'));
    }

    /**
     * @dataProvider fileProvider
     * @covers Respect\Validation\Rules\Exists::validate
     */
    public function testShouldValidateObjects($file)
    {
        $rule = new Exists();
        $object = new SplFileInfo($file->url());
        $this->assertTrue($rule->validate($object));
    }

    public function fileProvider()
    {
        $root = vfsStream::setup();
        $file = vfsStream::newFile('2kb.txt')->withContent(LargeFileContent::withKilobytes(2))->at($root);

        return [
            [$file]
        ];
    }
}
