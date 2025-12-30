<?php

declare(strict_types=1);

test(
    'not() should work by builder',
    fn() => expect(v::not(v::intVal())->isValid(10))->toBeFalse(),
);
