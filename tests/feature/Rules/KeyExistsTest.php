<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default mode', expectAll(
    fn() => v::keyExists('foo')->assert(['bar' => 'baz']),
    '`.foo` must be present',
    '- `.foo` must be present',
    ['foo' => '`.foo` must be present'],
));

test('Inverted mode', expectAll(
    fn() => v::not(v::keyExists('foo'))->assert(['foo' => 'baz']),
    '`.foo` must not be present',
    '- `.foo` must not be present',
    ['foo' => '`.foo` must not be present'],
));

test('Custom name', expectAll(
    fn() => v::keyExists('foo')->setName('Custom name')->assert(['bar' => 'baz']),
    'Custom name must be present',
    '- Custom name must be present',
    ['foo' => 'Custom name must be present'],
));

test('Custom template', expectAll(
    fn() => v::keyExists('foo')->assert(['bar' => 'baz'], 'Custom template for {{name}}'),
    'Custom template for `.foo`',
    '- Custom template for `.foo`',
    ['foo' => 'Custom template for `.foo`'],
));
