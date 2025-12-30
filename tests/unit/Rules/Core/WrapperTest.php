<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Core\ConcreteWrapper;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Wrapper::class)]
final class WrapperTest extends TestCase
{
    #[Test]
    public function shouldUseWrappedToEvaluate(): void
    {
        $wrapped = Stub::pass(2);

        $wrapper = new ConcreteWrapper($wrapped);

        $input = 'Whatever';

        self::assertEquals($wrapped->evaluate($input), $wrapper->evaluate($input));
    }
}
