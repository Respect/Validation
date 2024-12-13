<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::hetu()->assert('010106A901O'),
    '"010106A901O" must be a valid Finnish personal identity code',
    '- "010106A901O" must be a valid Finnish personal identity code',
    ['hetu' => '"010106A901O" must be a valid Finnish personal identity code']
));

test('Inverted', expectAll(
    fn() => v::not(v::hetu())->assert('010106A9012'),
    '"010106A9012" must not be a valid Finnish personal identity code',
    '- "010106A9012" must not be a valid Finnish personal identity code',
    ['notHetu' => '"010106A9012" must not be a valid Finnish personal identity code']
));

test('With template', expectAll(
    fn() => v::hetu()->assert('010106A901O', 'That is not a HETU'),
    'That is not a HETU',
    '- That is not a HETU',
    ['hetu' => 'That is not a HETU']
));

test('With name', expectAll(
    fn() => v::hetu()->setName('Hetu')->assert('010106A901O'),
    'Hetu must be a valid Finnish personal identity code',
    '- Hetu must be a valid Finnish personal identity code',
    ['hetu' => 'Hetu must be a valid Finnish personal identity code']
));
