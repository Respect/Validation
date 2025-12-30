<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[CoversClass(PropertyExists::class)]
final class PropertyExistsTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldAlwaysInvalidateNonObjectValues(mixed $input): void
    {
        self::assertInvalidInput(new PropertyExists('foo'), $input);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithExistingProperties')]
    public function itShouldValidateExistingProperties(string $propertyName, object $object): void
    {
        self::assertValidInput(new PropertyExists($propertyName), $object);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithMissingProperties')]
    public function itShouldInvalidateMissingProperties(string $propertyName, object $object): void
    {
        self::assertInvalidInput(new PropertyExists($propertyName), $object);
    }
}
