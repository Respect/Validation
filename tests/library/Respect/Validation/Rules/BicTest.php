<?php
namespace Respect\Validation\Rules;

use malkusch\bav\ConfigurationRegistry;
use malkusch\bav\DefaultConfiguration;
use malkusch\bav\PDODataBackendContainer;

/**
 * @covers Respect\Validation\Rules\Bic
 */
class BicTest extends \PHPUnit_Framework_TestCase
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
     * @expectedExceptionMessage Cannot validate BIC for country "xx"
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        new Bic('xx');
    }

    public function testCountryCodeIsCaseUnsensitive()
    {
        $rule1 = new Bic('de');
        $rule2 = new Bic('DE');

        $this->assertSame($rule1->validate('foo'), $rule2->validate('foo'));
    }

    /**
     * @dataProvider providerForValidBIC
     */
    public function testValidBICShouldReturnTrue($countryCode, $bic)
    {
        $rule = new Bic($countryCode);

        $this->assertTrue($rule->validate($bic));
    }

    /**
     * @dataProvider providerForNotBIC
     * @expectedException Respect\Validation\Exceptions\BicException
     * @expectedExceptionMessageRegExp /^"[^"]+" must be a BIC$/
     */
    public function testInvalidBICShouldRaiseException($countryCode, $bic)
    {
        $rule = new Bic($countryCode);
        $rule->check($bic);
    }

    /**
     * @dataProvider providerForNotBIC
     */
    public function testInvalidBICShouldReturnFalse($countryCode, $bic)
    {
        $rule = new Bic($countryCode);

        $this->assertFalse($rule->validate($bic));
    }

    public function providerForValidBic()
    {
        return array(
            array('de', 'VZVDDED1XXX'),
            array('de', 'VZVDDED1'),
        );
    }

    public function providerForNotBic()
    {
        return array(
            array('de', 'VZVDDED1~~~'),
        );
    }
}
