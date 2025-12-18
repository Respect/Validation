<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::templated(v::stringType(), 'Template in "Templated"')->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['stringType' => 'Template in "Templated"'])
));

test('With parameters', catchAll(
    fn() => v::templated(v::stringType(), 'Template in {{source}}', ['source' => 'Templated'])->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['stringType' => 'Template in "Templated"'])
));

test('Inverted', catchAll(
    fn() => v::not(v::templated(v::intType(), 'Template in "Templated"'))->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['notIntType' => 'Template in "Templated"'])
));

test('Template in Validator', catchAll(
    fn() => v::templated(v::stringType(), 'Template in "Templated"')
        ->setTemplate('Template in "Validator"')
        ->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['stringType' => 'Template in "Templated"'])
));

test('Template passed to Validator::assert()', catchAll(
    fn() => v::templated(v::stringType(), 'Template in "Templated"')->assert(10, 'Template in "Validator::assert"'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['stringType' => 'Template in "Templated"'])
));

test('With bound', catchAll(
    fn() => v::templated(v::attributes(), 'Template in "Templated"')->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['attributes' => 'Template in "Templated"'])
));
