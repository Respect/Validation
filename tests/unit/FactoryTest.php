<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Rules\Uppercase;

/**
 * @covers \Respect\Validation\Factory
 */
class FactoryTest extends TestCase
{
    public function testShouldHaveRulePrefixesByDefault(): void
    {
        $factory = new Factory();

        self::assertEquals(['Respect\\Validation\\Rules\\'], $factory->getRulePrefixes());
    }

    /**
     * @dataProvider provideRulePrefixes
     */
    public function testShouldBeAbleToAppendANewPrefix($namespace, $expectedNamespace): void
    {
        $factory = new Factory();
        $factory->appendRulePrefix($namespace);

        $currentRulePrefixes = $factory->getRulePrefixes();

        self::assertSame(
            $expectedNamespace,
            array_pop($currentRulePrefixes),
            'Appended namespace rule was not found as expected into the prefix list.'.PHP_EOL.
            sprintf(
                'Appended "%s", current list is '.PHP_EOL.'%s',
                $namespace,
                implode(PHP_EOL, $factory->getRulePrefixes())
            )
        );
    }

    /**
     * @dataProvider provideRulePrefixes
     */
    public function testShouldBeAbleToPrependANewRulePrefix($namespace, $expectedNamespace): void
    {
        $factory = new Factory();
        $factory->prependRulePrefix($namespace);

        $currentRulePrefixes = $factory->getRulePrefixes();

        self::assertContains(
            $expectedNamespace,
            array_shift($currentRulePrefixes),
            'Prepended namespace rule was not found as expected into the prefix list.'.PHP_EOL.
            sprintf(
                'Prepended "%s", current list is '.PHP_EOL.'%s',
                $namespace,
                implode(PHP_EOL, $factory->getRulePrefixes())
            )
        );
    }

    public function provideRulePrefixes()
    {
        return [
            'Namespace with trailing separator' => [
                'namespace' => 'My\\Validation\\Rules\\',
                'expected' => 'My\\Validation\\Rules\\',
            ],
            'Namespace without trailing separator' => [
                'namespace' => 'My\\Validation\\Rules',
                'expected' => 'My\\Validation\\Rules\\',
            ],
        ];
    }

    public function testShouldCreateARuleByName(): void
    {
        $factory = new Factory();

        self::assertInstanceOf(Uppercase::class, $factory->rule('uppercase'));
    }

    public function testShouldDefineConstructorArgumentsWhenCreatingARule(): void
    {
        $factory = new Factory();
        $rule = $factory->rule('dateTime', ['Y-m-d']);

        self::assertEquals('Y-m-d', $rule->format);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "uterere" is not a valid rule name
     */
    public function testShouldThrowsAnExceptionWhenRuleNameIsNotValid(): void
    {
        $factory = new Factory();
        $factory->rule('uterere');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "Respect\Validation\Exceptions\AgeException" is not a valid respect rule
     */
    public function testShouldThrowsAnExceptionWhenRuleIsNotInstanceOfRuleInterface(): void
    {
        $factory = new Factory();
        $factory->appendRulePrefix('Respect\\Validation\\Exceptions\\');
        $factory->rule('AgeException');
    }
}
