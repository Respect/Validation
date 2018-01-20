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

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Test\DataProvider\UndefinedProvider;

/**
 * @group core
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AbstractSearcherTest extends TestCase
{
    use UndefinedProvider;

    /**
     * @test
     */
    public function shouldValidateFromDataSource(): void
    {
        $input = 'bar';

        $rule = $this->getMockForAbstractClass(AbstractSearcher::class);
        $rule
            ->expects($this->once())
            ->method('getDataSource')
            ->willReturn(['foo', $input, 'baz']);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function shouldNotFindWhenNotIdentical(): void
    {
        $input = 2.0;

        $rule = $this->getMockForAbstractClass(AbstractSearcher::class);
        $rule
            ->expects($this->once())
            ->method('getDataSource')
            ->willReturn([1, (int) $input, 3]);

        self::assertFalse($rule->validate($input));
    }

    /**
     * @test
     * @dataProvider providerForUndefined
     */
    public function shouldValidateWhenValueIsUndefinedAndDataSourceIsEmpty($input): void
    {
        $rule = $this->getMockForAbstractClass(AbstractSearcher::class);
        $rule
            ->expects($this->once())
            ->method('getDataSource')
            ->willReturn([]);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     * @dataProvider providerForNotUndefined
     */
    public function shouldNotValidateWhenValueIsNotUndefinedAndDataSourceNotEmpty($input): void
    {
        $rule = $this->getMockForAbstractClass(AbstractSearcher::class);
        $rule
            ->expects($this->once())
            ->method('getDataSource')
            ->willReturn([]);

        self::assertFalse($rule->validate($input));
    }
}
