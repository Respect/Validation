<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::uuid()->assert('g71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    '"g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID',
));

test('Scenario #2', expectMessage(
    fn() => v::uuid(1)->assert('e0b5ffb9-9caf-2a34-9673-8fc91db78be6'),
    '"e0b5ffb9-9caf-2a34-9673-8fc91db78be6" must be a valid UUID version 1',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::uuid())->assert('fb3a7909-8034-59f5-8f38-21adbc168db7'),
    '"fb3a7909-8034-59f5-8f38-21adbc168db7" must not be a valid UUID',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::uuid(3))->assert('11a38b9a-b3da-360f-9353-a5a725514269'),
    '"11a38b9a-b3da-360f-9353-a5a725514269" must not be a valid UUID version 3',
));

test('Scenario #5', expectFullMessage(
    fn() => v::uuid()->assert('g71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    '- "g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID',
));

test('Scenario #6', expectFullMessage(
    fn() => v::uuid(4)->assert('a71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    '- "a71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID version 4',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::uuid())->assert('e0b5ffb9-9caf-4a34-9673-8fc91db78be6'),
    '- "e0b5ffb9-9caf-4a34-9673-8fc91db78be6" must not be a valid UUID',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::uuid(5))->assert('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62'),
    '- "c4a760a8-dbcf-5254-a0d9-6a4474bd1b62" must not be a valid UUID version 5',
));
