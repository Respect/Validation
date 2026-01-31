<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\ValidatorBuilder;

test('Scenario', catchMessage(
    fn() => v::templated('{{subject}} is not tasty', ValidatorBuilder::satisfies('is_int'))->assert('something'),
    fn(string $message) => expect($message)->toBe('"something" is not tasty'),
));
