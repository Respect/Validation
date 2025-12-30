<?php

declare(strict_types=1);

use Respect\Validation\Validator;

test('Scenario #1', catchFullMessage(
    fn() => Validator::stringType()->lengthBetween(2, 15)->assert(0),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - 0 must pass all the rules
          - 0 must be a string
          - 0 must be a countable value or a string
        FULL_MESSAGE),
));
