<?php
namespace Respect\Validation\Rules;

use malkusch\bav\ConfigurationRegistry;
use malkusch\bav\DefaultConfiguration;
use malkusch\bav\PDODataBackendContainer;

/**
 * @large
 */
class BICTest extends \PHPUnit_Framework_TestCase
{
    
    public static function setUpBeforeClass()
    {
        $configuration = new DefaultConfiguration();
        
        $pdo = new \PDO('sqlite::memory:');
        $configuration->setDataBackendContainer(new PDODataBackendContainer($pdo));
        
        ConfigurationRegistry::setConfiguration($configuration);
    }
    
    public static function tearDownAfterClass()
    {
        ConfigurationRegistry::setConfiguration(new DefaultConfiguration());
    }
            
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        $validator = new BIC("xx");
    }
    
    public function testCountryCodeIsCaseUnsensitive()
    {
        $validator1 = new BIC("de");
        $validator1->validate("foo");
        
        $validator2 = new BIC("DE");
        $validator2->validate("foo");
    }
    
    /**
     * @dataProvider providerForValidBIC
     */
    public function testValidBICShouldReturnTrue(BIC $validator, $bic)
    {
        $this->assertTrue($validator->__invoke($bic));
        $this->assertTrue($validator->assert($bic));
        $this->assertTrue($validator->check($bic));
    }

    /**
     * @dataProvider providerForNotBIC
     * @expectedException Respect\Validation\Exceptions\BICException
     */
    public function testInvalidBICShouldRaiseException(BIC $validator, $bic)
    {
        $this->assertFalse($validator->check($bic));
    }

    /**
     * @dataProvider providerForNotBIC
     */
    public function testInvalidBICShouldReturnFalse(BIC $validator, $bic)
    {
        $this->assertFalse($validator->__invoke($bic));
    }
    
    public function providerForValidBIC()
    {
        return array(
            array(new BIC("de"), "VZVDDED1XXX"),
            array(new BIC("de"), "VZVDDED1")
        );
    }
    
    public function providerForNotBIC()
    {
        return array(
            array(new BIC("de"), "VZVDDED1~~~")
        );
    }
}

