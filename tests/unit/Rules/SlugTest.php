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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Slug
 */
class SlugTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerValidSlug
     */
    public function testValidSlug($input)
    {
        $rule = new Slug();

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerInvalidSlug
     */
    public function testInvalidSlug($input)
    {
        $rule = new Slug();
        
        $this->assertFalse($rule->validate($input));
    }

    public function providerValidSlug()
    {
        return array(
            array('o-rato-roeu-o-rei-de-roma'),
            array('o-alganet-e-um-feio'),
            array('a-e-i-o-u'),
            array('anticonstitucionalissimamente'),
        );
    }

    public function providerInvalidSlug()
    {
        return array(
            array(''),
            array('o-alganet-é-um-feio'),
            array('á-é-í-ó-ú'),
            array('-assim-nao-pode'),
            array('assim-tambem-nao-'),
            array('nem--assim'),
            array('--nem-assim'),
            array('Nem mesmo Assim'),
            array('Ou-ate-assim'),
            array('-Se juntar-tudo-Então-'),
        );
    }
}
