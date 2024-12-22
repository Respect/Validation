<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', expectMessageAndError(
    fn() => v::length(0, 5, false)->assert('forest'),
    'The length of "forest" must be less than 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(5) instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::length(10, 20)->assert('river'),
    'The length of "river" must be between 10 and 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(10, 20) instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::length(15, null, false)->assert('mountain'),
    'The length of "mountain" must be greater than 15',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(15) instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::length(20)->assert('ocean'),
    'The length of "ocean" must be greater than or equal to 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(20) instead.',
));

test('Scenario #5', expectMessageAndError(
    fn() => v::length(2, 5)->assert('desert'),
    'The length of "desert" must be between 2 and 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(2, 5) instead.',
));

test('Scenario #6', expectMessageAndError(
    fn() => v::not(v::length(0, 15))->assert('rainforest'),
    'The length of "rainforest" must be greater than 15',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThanOrEqual(15) instead.',
));

test('Scenario #7', expectMessageAndError(
    fn() => v::not(v::length(0, 20, false))->assert('glacier'),
    'The length of "glacier" must not be less than 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(20) instead.',
));

test('Scenario #8', expectMessageAndError(
    fn() => v::not(v::length(3, null))->assert('meadow'),
    'The length of "meadow" must be less than 3',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(3) instead.',
));

test('Scenario #9', expectMessageAndError(
    fn() => v::not(v::length(5, null, false))->assert('volcano'),
    'The length of "volcano" must not be greater than 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(5) instead.',
));

test('Scenario #10', expectMessageAndError(
    fn() => v::not(v::length(5, 20))->assert('canyon'),
    'The length of "canyon" must not be between 5 and 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(5, 20) instead.',
));

test('Scenario #11', expectMessageAndError(
    fn() => v::length(0, 5, false)->assert('prairie'),
    'The length of "prairie" must be less than 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(5) instead.',
));

test('Scenario #12', expectMessageAndError(
    fn() => v::length(0, 5)->assert('wetland'),
    'The length of "wetland" must be less than or equal to 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThanOrEqual(5) instead.',
));

test('Scenario #13', expectMessageAndError(
    fn() => v::length(15, null, false)->assert('tundra'),
    'The length of "tundra" must be greater than 15',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(15) instead.',
));

test('Scenario #14', expectMessageAndError(
    fn() => v::length(20)->assert('savanna'),
    'The length of "savanna" must be greater than or equal to 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(20) instead.',
));

test('Scenario #15', expectMessageAndError(
    fn() => v::length(7, 10)->assert('marsh'),
    'The length of "marsh" must be between 7 and 10',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(7, 10) instead.',
));

test('Scenario #16', expectMessageAndError(
    fn() => v::length(4, 10, false)->assert('reef'),
    'The length of "reef" must be greater than 4 and less than 10',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetweenExclusive(4, 10) instead.',
));

test('Scenario #17', expectMessageAndError(
    fn() => v::not(v::length(0, 15))->assert('valley'),
    'The length of "valley" must be greater than 15',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThanOrEqual(15) instead.',
));

test('Scenario #18', expectMessageAndError(
    fn() => v::not(v::length(0, 20, false))->assert('island'),
    'The length of "island" must not be less than 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthLessThan(20) instead.',
));

test('Scenario #19', expectMessageAndError(
    fn() => v::not(v::length(5, null))->assert('plateau'),
    'The length of "plateau" must be less than 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThanOrEqual(5) instead.',
));

test('Scenario #20', expectMessageAndError(
    fn() => v::not(v::length(3, null, false))->assert('fjord'),
    'The length of "fjord" must not be greater than 3',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthGreaterThan(3) instead.',
));

test('Scenario #21', expectMessageAndError(
    fn() => v::not(v::length(5, 20))->assert('delta'),
    'The length of "delta" must not be between 5 and 20',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetween(5, 20) instead.',
));

test('Scenario #22', expectMessageAndError(
    fn() => v::not(v::length(5, 11, false))->assert('waterfall'),
    'The length of "waterfall" must not be greater than 5 or less than 11',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthBetweenExclusive(5, 11) instead.',
));

test('Scenario #23', expectMessageAndError(
    fn() => v::length(8, 8)->assert('estuary'),
    'The length of "estuary" must be equal to 8',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthEquals(8) instead.',
));

test('Scenario #24', expectMessageAndError(
    fn() => v::not(v::length(5, 5))->assert('grove'),
    'The length of "grove" must not be equal to 5',
    'Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use lengthEquals(5) instead.',
));
