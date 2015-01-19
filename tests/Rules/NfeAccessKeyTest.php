<?php

namespace Respect\Validation\Rules;

class NfeAccessKeyTest extends \PHPUnit_Framework_TestCase
{
    protected $nfeValidator;

    protected function setUp()
    {
        $this->nfeValidator = new NfeAccessKey();
    }

    /**
     * @dataProvider validAccessKeyProvider
     */
    public function testValidAccessKey($aK)
    {
        $this->assertTrue($this->nfeValidator->assert($aK));
        $this->assertTrue($this->nfeValidator->__invoke($aK));
        $this->assertTrue($this->nfeValidator->check($aK));
    }

    /**
     * @dataProvider invalidAccessKeyProvider
     * @expectedException Respect\Validation\Exceptions\NfeAccessKeyException
     */
    public function testInvalidAccessKey($aK)
    {
        $this->assertFalse($this->nfeValidator->assert($aK));
    }

    /**
     * @dataProvider invalidAccessKeyLengthProvider
     * @expectedException Respect\Validation\Exceptions\NfeAccessKeyException
     */
    public function testInvalidLengthCnh($aK)
    {
        $this->assertFalse($this->nfeValidator->assert($aK));
    }
    
    public function validAccessKeyProvider()
    {
        return array(
            array('52060433009911002506550120000007800267301615')
        );
    }

    public function invalidAccessKeyProvider()
    {
        return array(
            array('31841136830118868211870485416765268625116906'),
            array('21470801245862435081451225624565260861852679'),
            array('45644318091447671194616059650873352394885852'),
            array('17214281716057582143671174314277906696193888'),
            array('56017280182977836779696364362142515138726654'),
            array('90157126614010548506235171976891004177042525'),
            array('78457064241662300187501877048374851128754067'),
            array('39950148079977322431982386613620895568235903'),
            array('90820939577654114875253907311677136672761216')
        );
    }

    public function invalidAccessKeyLengthProvider()
    {
        return array(
            array('11145573386990252067204852181837301'),
            array('6209433147444876'),
            array('00745996227609395385255721262102'),
            array('58215798856653'),
            array('24149625439084262707824706699374326'),
            array('163907274335'),
            array('67229454773008929675906894698'),
            array('5858836670181917762140106857095788313119136'),
            array('6098412281885524361833754087461339281130'),
            array('9025299113310221')
        );
    }
}

