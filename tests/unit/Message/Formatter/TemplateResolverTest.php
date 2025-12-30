<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Path;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\TestCase;

#[CoversClass(TemplateResolver::class)]
final class TemplateResolverTest extends TestCase
{
    #[Test]
    public function itShouldReturnResultWithTemplateWhenKeyExists(): void
    {
        $result = (new ResultBuilder())->withPath(new Path('foo-path'))->build();
        $templates = ['foo-path' => 'My custom template'];
        $sut = new TemplateResolver();
        $template = $sut->getGivenTemplate($result, $templates);

        self::assertSame('My custom template', $template);
    }
}
