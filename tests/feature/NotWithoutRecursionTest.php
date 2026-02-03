<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\ValidatorBuilder;

test('Scenario #1', catchMessage(function (): void {
    $validator = ValidatorBuilder::not(ValidatorBuilder::intVal()->positive());
    $validator->assert(2);
},
fn(string $message) => expect($message)->toBe('2 must not be an integer value')));
