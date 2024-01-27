--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::readable()->check('tests/fixtures/invalid-image.jpg'));
exceptionMessage(static fn() => v::not(v::readable())->check('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::readable()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"tests/fixtures/invalid-image.jpg" must be readable
"tests/fixtures/valid-image.png" must not be readable
- `[object] (stdClass: { })` must be readable
- "tests/fixtures/valid-image.png" must not be readable
