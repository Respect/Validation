<?php

declare(strict_types=1);

test('Scenario #1', catchMessages(
    fn() => v::alnum()
        ->notSpaced()
        ->length(v::between(1, 15))
        ->assert('really messed up screen#name', [
            'alnum' => '{{subject}} must contain only letters and digits',
            'notSpaced' => '{{subject}} cannot contain spaces',
            'length' => '{{subject}} must not have more than 15 chars',
        ]),
    fn(array $messages) => expect($messages)->toBe([
        '__root__' => '"really messed up screen#name" must pass all the rules',
        'alnum' => '"really messed up screen#name" must contain only letters and digits',
        'notSpaced' => '"really messed up screen#name" cannot contain spaces',
        'lengthBetween' => 'The length of "really messed up screen#name" must be between 1 and 15',
    ]),
));
