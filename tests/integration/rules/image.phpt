--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::image()->check('tests/fixtures/invalid-image.png'));
exceptionMessage(static fn() => v::not(v::image())->check('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::image()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::image())->assert('tests/fixtures/valid-image.gif'));
?>
--EXPECT--
"tests/fixtures/invalid-image.png" must be a valid image
"tests/fixtures/valid-image.png" must not be a valid image
- `[object] (stdClass: { })` must be a valid image
- "tests/fixtures/valid-image.gif" must not be a valid image
