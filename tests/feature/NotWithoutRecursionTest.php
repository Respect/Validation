<?php

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', catchMessage(function (): void {
    $validator = Validator::not(Validator::intVal()->positive());
    $validator->assert(2);
},
fn(string $message) => expect($message)->toBe('2 must not be an integer value')));
