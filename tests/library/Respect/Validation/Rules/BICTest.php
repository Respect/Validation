<?php
namespace Respect\Validation\Rules;

use malkusch\bav\ConfigurationRegistry;
use malkusch\bav\DefaultConfiguration;
use malkusch\bav\PDODataBackendContainer;

/**
 * @covers Respect\Validation\Rules\BIC
 */
class BICTest extends \PHPUnit_Framework_TestCase
{
    protected static function isAvailable()
    {
        return class_exists('malkusch\\bav\\BAV');
    }

    protected function setUp()
    {
        if (false === self::isAvailable()) {
            $this->markTestSkipped('"malkusch/bav" is not installed.');
        }
    }

    public static function setUpBeforeClass()
    {
        if (false === self::isAvailable()) {
            return;
        }

        $configuration = new DefaultConfiguration();

        $pdo = new \PDO('sqlite::memory:');
        $configuration->setDataBackendContainer(new PDODataBackendContainer($pdo));

        ConfigurationRegistry::setConfiguration($configuration);
    }

    public static function tearDownAfterClass()
    {
        if (false === self::isAvailable()) {
            return;
        }

        ConfigurationRegistry::setConfiguration(new DefaultConfiguration());
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate BIC for country 'xx'.
     */
    public function testUnsupportedCountryCodeRaisesException()
    {
        new BIC('xx');
    }

    public function testCountryCodeIsCaseUnsensitive()
    {
        $rule1 = new BIC('de');
        $rule2 = new BIC('DE');

        $this->assertSame($rule1->validate('foo'), $rule2->validate('foo'));
    }

    /**
     * @dataProvider providerForValidBIC
     */
    public function testValidBICShouldReturnTrue($countryCode, $bic)
    {
        $rule = new BIC($countryCode);

        $this->assertTrue($rule->validate($bic));
    }

    /**
     * @dataProvider providerForNotBIC
     * @expectedException Respect\Validation\Exceptions\BICException
     * @expectedExceptionMessageRegExp /^"[^"]+" must be a BIC$/
     */
    public function testInvalidBICShouldRaiseException($countryCode, $bic)
    {
        $rule = new BIC($countryCode);
        $rule->check($bic);
    }

    /**
     * @dataProvider providerForNotBIC
     */
    public function testInvalidBICShouldReturnFalse($countryCode, $bic)
    {
        $rule = new BIC($countryCode);

        $this->assertFalse($rule->validate($bic));
    }

    public function providerForValidBIC()
    {
        return array(
            array('de', 'VZVDDED1XXX'),
            array('de', 'VZVDDED1'),
        );
    }

    public function providerForNotBIC()
    {
        return array(
            array('de', 'VZVDDED1~~~'),
        );
    }
}
