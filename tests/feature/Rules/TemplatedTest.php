<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::templated('Template in "Templated"', v::stringType())->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['stringType' => 'Template in "Templated"']),
));

test('With parameters', catchAll(
    fn() => v::templated('Template in {{source}}', v::stringType(), ['source' => 'Templated'])->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['stringType' => 'Template in "Templated"']),
));

test('Inverted', catchAll(
    fn() => v::not(v::templated('Template in "Templated"', v::intType()))->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['notIntType' => 'Template in "Templated"']),
));

test('Template passed to Validator::assert()', catchAll(
    fn() => v::templated('Template in "Templated"', v::stringType())->assert(10, 'Template in "Validator::assert"'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Validator::assert"')
        ->and($fullMessage)->toBe('- Template in "Validator::assert"')
        ->and($messages)->toBe(['stringType' => 'Template in "Validator::assert"']),
));

test('With bound', catchAll(
    fn() => v::templated('Template in "Templated"', v::attributes())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Template in "Templated"')
        ->and($fullMessage)->toBe('- Template in "Templated"')
        ->and($messages)->toBe(['attributes' => 'Template in "Templated"']),
));
