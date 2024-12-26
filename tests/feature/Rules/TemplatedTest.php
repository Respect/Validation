<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::templated(v::stringType(), 'Template in "Templated"')->assert(12),
    'Template in "Templated"',
    '- Template in "Templated"',
    ['stringType' => 'Template in "Templated"'],
));

test('With parameters', expectAll(
    fn() => v::templated(v::stringType(), 'Template in {{source}}', ['source' => 'Templated'])->assert(12),
    'Template in "Templated"',
    '- Template in "Templated"',
    ['stringType' => 'Template in "Templated"'],
));

test('Inverted', expectAll(
    fn() => v::not(v::templated(v::intType(), 'Template in "Templated"'))->assert(12),
    'Template in "Templated"',
    '- Template in "Templated"',
    ['notIntType' => 'Template in "Templated"'],
));

test('Template in Validator', expectAll(
    fn() => v::templated(v::stringType(), 'Template in "Templated"')
        ->setTemplate('Template in "Validator"')
        ->assert(12),
    'Template in "Templated"',
    '- Template in "Templated"',
    ['stringType' => 'Template in "Templated"'],
));

test('Template passed to Validator::assert()', expectAll(
    fn() => v::templated(v::stringType(), 'Template in "Templated"')->assert(10, 'Template in "Validator::assert"'),
    'Template in "Templated"',
    '- Template in "Templated"',
    ['stringType' => 'Template in "Templated"'],
));

test('With bound', expectAll(
    fn() => v::templated(v::attributes(), 'Template in "Templated"')->assert(null),
    'Template in "Templated"',
    '- Template in "Templated"',
    ['attributes' => 'Template in "Templated"'],
));
