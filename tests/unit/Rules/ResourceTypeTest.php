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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\ResourceType
 * @covers \Respect\Validation\Exceptions\ResourceTypeException
 */
class ResourceTypeTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        $this->rule = new ResourceType();
    }

    /**
     * @dataProvider providerForResource
     */
    public function testShouldValidateResourceNumbers($input): void
    {
        self::assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonResource
     */
    public function testShouldNotValidateNonResourceNumbers($input): void
    {
        self::assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ResourceTypeException
     * @expectedExceptionMessage "Something" must be a resource
     */
    public function testShouldThrowResourceExceptionWhenChecking(): void
    {
        $this->rule->check('Something');
    }

    public function providerForResource()
    {
        return [
            [stream_context_create()],
            [tmpfile()],
            [xml_parser_create()],
        ];
    }

    public function providerForNonResource()
    {
        return [
            ['String'],
            [123],
            [[]],
            [function (): void {
            }],
            [new \stdClass()],
            [null],
        ];
    }
}
