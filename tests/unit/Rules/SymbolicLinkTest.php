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

use Respect\Validation\TestCase;
use SplFileInfo;

$GLOBALS['is_link'] = null;

function is_link($link)
{
    $return = \is_link($link);
    if (null !== $GLOBALS['is_link']) {
        $return = $GLOBALS['is_link'];
        $GLOBALS['is_link'] = null;
    }

    return $return;
}

/**
 * @group  rule
 * @covers Respect\Validation\Rules\SymbolicLink
 * @covers Respect\Validation\Exceptions\SymbolicLinkException
 */
class SymbolicLinkTest extends TestCase
{
    /**
     * @covers Respect\Validation\Rules\SymbolicLink::validate
     */
    public function testValidSymbolicLinkShouldReturnTrue()
    {
        $GLOBALS['is_link'] = true;

        $rule = new SymbolicLink();
        $input = '/path/of/a/valid/link.lnk';
        $this->assertTrue($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\SymbolicLink::validate
     */
    public function testInvalidSymbolicLinkShouldThrowException()
    {
        $GLOBALS['is_link'] = false;

        $rule = new SymbolicLink();
        $input = '/path/of/an/invalid/link.lnk';
        $this->assertFalse($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\SymbolicLink::validate
     */
    public function testShouldValidateObjects()
    {
        $rule = new SymbolicLink();
        $object = new SplFileInfo('tests/fixtures/symbolic-link');

        $this->assertTrue($rule->validate($object));
    }
}
