<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Graph::class)]
final class GraphTest extends RuleTestCase
{
    /** @return iterable<array{Graph, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $graph = new Graph();

        return [
            'String with special characters "LKA#@%.54"' => [$graph, 'LKA#@%.54'],
            'String "foobar"' => [$graph, 'foobar'],
            'String 16-50' => [$graph, '16-50'],
            'String 123' => [$graph, '123'],
            'String with special characters "#$%&*_"' => [$graph, '#$%&*_'],
            'Ignoring control characters "\n"' => [new Graph("\n"), "#$%&*_\n~"],
            'Ignoring control characters "\n#\t&\r"' => [new Graph("\n#\t&\r"), "#$%&*_\n~\t**\r"],
            'Ignoring character "_"' => [new Graph('_'), 'abc\#$%&*_'],
            'Ignoring characters "# $"' => [new Graph('# $'), '#$%&*_'],
            'Ignoring character with space' => [new Graph(' '), '!@#$%^&*(){} abc 123'],
            'Ignoring control characters " \t\n"' => [new Graph(" \t\n"), "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /** @return iterable<array{Graph, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $graph = new Graph();

        return [
            'String empty' => [$graph, ''],
            'Parameter null' => [$graph, null],
            'String with "\n"' => [$graph, "foo\nbar"],
            'String with "\t"' => [$graph, "foo\tbar"],
            'String with "foo bar"' => [$graph, 'foo bar'],
            'String with space' => [$graph, ' '],
            'Igonring space' => [new Graph(' '), "@__§¬¬¬\n"],
            'Ignoring control characters "foo\nbar"' => [new Graph("foo\nbar"), "foo\nbar\ree"],
        ];
    }
}
