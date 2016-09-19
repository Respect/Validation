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
 * @covers Respect\Validation\Rules\Cnh
 * @covers Respect\Validation\Exceptions\CnhException
 */
class CnhTest extends \PHPUnit_Framework_TestCase
{
    protected $cnhValidator;

    protected function setUp()
    {
        $this->cnhValidator = new Cnh();
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
        return [
               ['02650306461'],
               ['04397322870'],
               ['04375701302'],
               ['02996843266'],
               ['04375700501'],
               ['02605113410'],
               ['03247061306'],
               ['01258750259'],
               ['00739751580'],
               ['03375637504'],
               ['02542551342'],
               ['01708111400'],
               ['00836510948'],
               ['04365445978'],
               ['04324384302'],
               ['04339482949'],
               ['01036520050'],
               ['01612581027'],
               ['00603454740'],
               ['04129251992'],
               ['03401740201'],
               ['03417248301'],
               ['00670431345'],
               ['03292694405'],
        ];
    }

    public function invalidCnhProvider()
    {
        return [
               [[]],
               [new \stdClass()],
               ['0265131640'],
               ['0439732280'],
               ['0437571130'],
               ['0299684320'],
               ['0437571150'],
               ['0261511340'],
               ['0324716130'],
               ['0125875120'],
               ['0173975150'],
               ['0337563750'],
               ['0254255130'],
               ['0171811140'],
               ['0183651190'],
               ['0436544590'],
               ['0432438430'],
               ['0433948290'],
               ['0113652110'],
               ['0161258110'],
               ['0161345470'],
               ['0412925190'],
               ['0341174120'],
               ['0341724830'],
               ['0167143130'],
               ['0329269440'],
        ];
    }

    public function notIntegerCnhProvider()
    {
        return [
               [''],
               ['F265F3F6461'],
               ['F439732287F'],
               ['F43757F13F2'],
               ['F2996843266'],
               ['F43757FF5F1'],
               ['F26F511341F'],
               ['F3247F613F6'],
               ['F125875F259'],
               ['FF73975158F'],
               ['F33756375F4'],
               ['F2542551342'],
               ['F17F81114FF'],
               ['FF83651F948'],
               ['F4365445978'],
               ['F43243843F2'],
               ['F4339482949'],
               ['F1F3652FF5F'],
               ['F1612581F27'],
               ['FF6F345474F'],
               ['F4129251992'],
               ['F34F174F2F1'],
               ['F34172483F1'],
               ['FF67F431345'],
               ['F32926944F5'],
        ];
    }

    public function invalidCnhLengthProvider()
    {
        return [
               ['00265003006461'],
               ['0043973228700'],
               ['00437570013002'],
               ['002996843266'],
               ['004375700005001'],
               ['00260051134100'],
               ['00324700613006'],
               ['0012587500259'],
               ['00007397515800'],
               ['0033756375004'],
               ['002542551342'],
               ['001700811140000'],
               ['00008365100948'],
               ['004365445978'],
               ['0043243843002'],
               ['004339482949'],
               ['0010036520000500'],
               ['0016125810027'],
               ['000060034547400'],
               ['004129251992'],
               ['003400174002001'],
               ['0034172483001'],
               ['00006700431345'],
               ['0032926944005'],
        ];
    }
}
