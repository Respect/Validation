<?php

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Test\Rules\Invalid;
use Respect\Validation\Test\Rules\MyAbstractClass;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Rules\Valid;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Transformers\StubTransformer;

use function assert;
use function sprintf;

#[Group('core')]
#[CoversClass(NamespacedRuleFactory::class)]
final class NamespacedRuleFactoryTest extends TestCase
{
    private const string TEST_RULES_NAMESPACE = 'Respect\\Validation\\Test\\Rules';

    #[Test]
    public function shouldCreateRuleByNameBasedOnNamespace(): void
    {
        $factory = new NamespacedRuleFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        self::assertInstanceOf(Valid::class, $factory->create('valid'));
    }

    #[Test]
    public function shouldLookUpToAllNamespacesUntilRuleIsFound(): void
    {
        $factory = (new NamespacedRuleFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]))
            ->withRuleNamespace(__NAMESPACE__);

        self::assertInstanceOf(Valid::class, $factory->create('valid'));
    }

    #[Test]
    public function shouldDefineConstructorArgumentsWhenCreatingRule(): void
    {
        $constructorArguments = [true, false, true, false];

        $factory = new NamespacedRuleFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);
        $rule = $factory->create('stub', $constructorArguments);
        assert($rule instanceof Stub);

        self::assertSame($constructorArguments, $rule->validations);
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsInvalid(): void
    {
        $factory = new NamespacedRuleFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be an instance of "%s"', Invalid::class, Rule::class));

        $factory->create('invalid');
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsNotInstantiable(): void
    {
        $factory = new NamespacedRuleFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be instantiable', MyAbstractClass::class));

        $factory->create('myAbstractClass');
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsNotFound(): void
    {
        $factory = new NamespacedRuleFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"nonExistingRule" is not a valid rule name');

        $factory->create('nonExistingRule');
    }
}
