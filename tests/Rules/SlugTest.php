<?php
namespace Respect\Validation\Rules;

class SlugTest extends \PHPUnit_Framework_TestCase
{
    protected $slug;

    protected function setUp()
    {
        $this->slug = new Slug;
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
            array(''),
            array('o-rato-roeu-o-rei-de-roma'),
            array('o-alganet-e-um-feio'),
            array('a-e-i-o-u'),
            array('anticonstitucionalissimamente')
        );
    }

    public function providerInvalidSlug()
    {
        return array(
            array('o-alganet-é-um-feio'),
            array('á-é-í-ó-ú'),
            array('-assim-nao-pode'),
            array('assim-tambem-nao-'),
            array('nem--assim'),
            array('--nem-assim'),
            array('Nem mesmo Assim'),
            array('Ou-ate-assim'),
            array('-Se juntar-tudo-Então-')
        );
    }
}

