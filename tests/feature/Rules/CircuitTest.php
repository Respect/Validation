<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())->assert(false),
    '`false` must evaluate to `true`',
    '- `false` must evaluate to `true`',
    ['trueVal' => '`false` must evaluate to `true`'],
));

test('Inverted', expectAll(
    fn() => v::not(v::circuit(v::alwaysValid(), v::trueVal()))->assert(true),
    '`true` must not evaluate to `true`',
    '- `true` must not evaluate to `true`',
    ['notTrueVal' => '`true` must not evaluate to `true`'],
));

test('Default with inverted failing rule', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::not(v::trueVal()))->assert(true),
    '`true` must not evaluate to `true`',
    '- `true` must not evaluate to `true`',
    ['notTrueVal' => '`true` must not evaluate to `true`'],
));

test('With wrapped name, default', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal()->setName('Wrapped'))->setName('Wrapper')->assert(false),
    'Wrapped must evaluate to `true`',
    '- Wrapped must evaluate to `true`',
    ['trueVal' => 'Wrapped must evaluate to `true`'],
));

test('With wrapper name, default', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())->setName('Wrapper')->assert(false),
    'Wrapper must evaluate to `true`',
    '- Wrapper must evaluate to `true`',
    ['trueVal' => 'Wrapper must evaluate to `true`'],
));

test('With the name set in the wrapped rule of an inverted failing rule', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::not(v::trueVal()->setName('Wrapped'))->setName('Not'))->setName('Wrapper')->assert(true),
    'Wrapped must not evaluate to `true`',
    '- Wrapped must not evaluate to `true`',
    ['notTrueVal' => 'Wrapped must not evaluate to `true`'],
));

test('With the name set in an inverted failing rule', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::not(v::trueVal())->setName('Not'))->setName('Wrapper')->assert(true),
    'Not must not evaluate to `true`',
    '- Not must not evaluate to `true`',
    ['notTrueVal' => 'Not must not evaluate to `true`'],
));

test('With the name set in the "circuit" that has an inverted failing rule', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::not(v::trueVal()))->setName('Wrapper')->assert(true),
    'Wrapper must not evaluate to `true`',
    '- Wrapper must not evaluate to `true`',
    ['notTrueVal' => 'Wrapper must not evaluate to `true`'],
));

test('With template', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())
        ->setTemplate('Circuit cool cats cunningly continuous cookies')
        ->assert(false),
    'Circuit cool cats cunningly continuous cookies',
    '- Circuit cool cats cunningly continuous cookies',
    ['trueVal' => 'Circuit cool cats cunningly continuous cookies'],
));

test('With multiple templates', expectAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())
        ->setTemplates(['trueVal' => 'Clever clowns craft circuit clever clocks'])
        ->assert(false),
    'Clever clowns craft circuit clever clocks',
    '- Clever clowns craft circuit clever clocks',
    ['trueVal' => 'Clever clowns craft circuit clever clocks'],
));

test('Real example', expectAll(
    fn() => v::circuit(
        v::key('countyCode', v::countryCode()),
        v::lazy(fn ($input) => v::key('subdivisionCode', v::subdivisionCode($input['countyCode']))),
    )->assert(['countyCode' => 'BR', 'subdivisionCode' => 'CA']),
    '`.subdivisionCode` must be a subdivision code of Brazil',
    '- `.subdivisionCode` must be a subdivision code of Brazil',
    ['subdivisionCode' => '`.subdivisionCode` must be a subdivision code of Brazil'],
));
