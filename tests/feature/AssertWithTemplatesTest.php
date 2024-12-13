<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Template as a string in the chain', expectAll(
    fn() => v::alwaysInvalid()->setTemplate('My string template in the chain')->assert(1),
    'My string template in the chain',
    '- My string template in the chain',
    ['alwaysInvalid' => 'My string template in the chain']
));

test('Template as an array in the chain', expectAll(
    fn() => v::alwaysInvalid()->setTemplates(['alwaysInvalid' => 'My array template in the chain'])->assert(1),
    'My array template in the chain',
    '- My array template in the chain',
    ['alwaysInvalid' => 'My array template in the chain']
));

test('Runtime template as string', expectAll(
    fn() => v::alwaysInvalid()->assert(1, 'My runtime template as string'),
    'My runtime template as string',
    '- My runtime template as string',
    ['alwaysInvalid' => 'My runtime template as string']
));

test('Runtime template as an array', expectAll(
    fn() => v::alwaysInvalid()->assert(1, ['alwaysInvalid' => 'My runtime template an array']),
    'My runtime template an array',
    '- My runtime template an array',
    ['alwaysInvalid' => 'My runtime template an array']
));
