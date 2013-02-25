<?php
namespace Respect\Validation\Rules;

class CnhTest extends \PHPUnit_Framework_TestCase
{
    protected $cnhValidator;

    protected function setUp()
    {
        $this->cnhValidator = new Cnh;
    }

    /**
     * @dataProvider validCnhProvider
     */
    public function testValidCnh($cnh)
    {
        $this->assertTrue($this->cnhValidator->assert($cnh));
        $this->assertTrue($this->cnhValidator->__invoke($cnh));
        $this->assertTrue($this->cnhValidator->check($cnh));
    }

    /**
     * @dataProvider invalidCnhProvider
     * @expectedException Respect\Validation\Exceptions\CnhException
     */
    public function testInvalidCnh($cnh)
    {
        $expectedInvalid = $this->cnhValidator->assert($cnh);
        $this->assertFalse($expectedInvalid);
    }

    /**
     * @dataProvider notIntegerCnhProvider
     * @expectedException Respect\Validation\Exceptions\CnhException
     */
    public function testNotIntegerCnh($cnh)
    {
        $expectedInvalid = $this->cnhValidator->assert($cnh);
        $this->assertFalse($expectedInvalid);
    }

    /**
     * @dataProvider invalidCnhLengthProvider
     * @expectedException Respect\Validation\Exceptions\CnhException
     */
    public function testInvalidLengthCnh($cnh)
    {
        $expectedInvalid = $this->cnhValidator->assert($cnh);
        $this->assertFalse($expectedInvalid);
    }

    public function validCnhProvider()
    {
        return array(
               array(''),
               array('02650306461'),
               array('04397322870'),
               array('04375701302'),
               array('02996843266'),
               array('04375700501'),
               array('02605113410'),
               array('03247061306'),
               array('01258750259'),
               array('00739751580'),
               array('03375637504'),
               array('02542551342'),
               array('01708111400'),
               array('00836510948'),
               array('04365445978'),
               array('04324384302'),
               array('04339482949'),
               array('01036520050'),
               array('01612581027'),
               array('00603454740'),
               array('04129251992'),
               array('03401740201'),
               array('03417248301'),
               array('00670431345'),
               array('03292694405'),
        );
    }

    public function invalidCnhProvider()
    {
        return array(
               array('12651316461'),
               array('14397322871'),
               array('14375711312'),
               array('12996843266'),
               array('14375711511'),
               array('12615113411'),
               array('13247161316'),
               array('11258751259'),
               array('11739751581'),
               array('13375637514'),
               array('12542551342'),
               array('11718111411'),
               array('11836511948'),
               array('14365445978'),
               array('14324384312'),
               array('14339482949'),
               array('11136521151'),
               array('11612581127'),
               array('11613454741'),
               array('14129251992'),
               array('13411741211'),
               array('13417248311'),
               array('11671431345'),
               array('13292694415'),
        );
    }

    public function notIntegerCnhProvider()
    {
        return array(
               array('F265F3F6461'),
               array('F439732287F'),
               array('F43757F13F2'),
               array('F2996843266'),
               array('F43757FF5F1'),
               array('F26F511341F'),
               array('F3247F613F6'),
               array('F125875F259'),
               array('FF73975158F'),
               array('F33756375F4'),
               array('F2542551342'),
               array('F17F81114FF'),
               array('FF83651F948'),
               array('F4365445978'),
               array('F43243843F2'),
               array('F4339482949'),
               array('F1F3652FF5F'),
               array('F1612581F27'),
               array('FF6F345474F'),
               array('F4129251992'),
               array('F34F174F2F1'),
               array('F34172483F1'),
               array('FF67F431345'),
               array('F32926944F5'),
        );
    }

    public function invalidCnhLengthProvider()
    {
        return array(
               array('00265003006461'),
               array('0043973228700'),
               array('00437570013002'),
               array('002996843266'),
               array('004375700005001'),
               array('00260051134100'),
               array('00324700613006'),
               array('0012587500259'),
               array('00007397515800'),
               array('0033756375004'),
               array('002542551342'),
               array('001700811140000'),
               array('00008365100948'),
               array('004365445978'),
               array('0043243843002'),
               array('004339482949'),
               array('0010036520000500'),
               array('0016125810027'),
               array('000060034547400'),
               array('004129251992'),
               array('003400174002001'),
               array('0034172483001'),
               array('00006700431345'),
               array('0032926944005'),
        );
    }
}

