<?php

namespace Respect\Validation\Rules;

class CPFTest extends \PHPUnit_Framework_TestCase
{

    
    public function testValidCPF()
    {
        $cpf = new CPF('342.444.198-88');
        $this->assertTrue($cpf->assert($cpf->cpf));
    }
    
    /**
    * @expectedException Respect\Validation\Exceptions\CPFException
    */
    public function testInvalidCPF()
    {
        $cpf = new CPF('111.111.111-51');
        $this->assertFalse($cpf->assert($cpf->cpf));
    }
}
