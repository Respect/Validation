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
 * @covers Respect\Validation\Exceptions\SlugException
 */
class SlugTest extends \PHPUnit_Framework_TestCase
{
    protected $slug;

    protected function setUp()
    {
        $this->slug = new Slug();
    }

    /**
     * @dataProvider providerValidSlug
     */
    public function testValidSlug($input)
    {
        $this->assertTrue($this->slug->__invoke($input));
        $this->assertTrue($this->slug->check($input));
        $this->assertTrue($this->slug->assert($input));
    }

    /**
     * @dataProvider providerInvalidSlug
     * @expectedException Respect\Validation\Exceptions\SlugException
     */
    public function testInvalidSlug($input)
    {
        $this->assertFalse($this->slug->__invoke($input));
        $this->assertFalse($this->slug->assert($input));
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
