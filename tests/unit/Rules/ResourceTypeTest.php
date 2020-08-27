<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function stream_context_create;
use function tmpfile;
use function xml_parser_create;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\ResourceType
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ResourceTypeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new ResourceType();

        return [
            [$rule, stream_context_create()],
            [$rule, tmpfile()],
        ];
    }

    /**
     * @test
     *
     * @requires PHP < 8.0
     */
    public function itShouldTestXmlResource(): void
    {
        $rule = new ResourceType();

        self::assertValidInput($rule, xml_parser_create());
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new ResourceType();

        return [
            [$rule, 'String'],
            [$rule, 123],
            [$rule, []],
            [
                $rule,
                static function (): void {
                },
            ],
            [$rule, new stdClass()],
            [$rule, null],
        ];
    }
}
