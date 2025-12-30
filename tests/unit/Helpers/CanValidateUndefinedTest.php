<?php

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('helper')]
final class CanValidateUndefinedTest extends TestCase
{
    use CanValidateUndefined;

    #[Test]
    #[DataProvider('providerForUndefined')]
    public function shouldFindWhenValueIsUndefined(mixed $value): void
    {
        self::assertTrue($this->isUndefined($value));
    }

    #[Test]
    #[DataProvider('providerForNotUndefined')]
    public function shouldFindWhenValueIsNotUndefined(mixed $value): void
    {
        self::assertFalse($this->isUndefined($value));
    }
}
