--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::image()->assert('tests/fixtures/invalid-image.png'));
exceptionMessage(static fn() => v::not(v::image())->assert('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::image()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::image())->assert('tests/fixtures/valid-image.gif'));
?>
--EXPECT--
"tests/fixtures/invalid-image.png" must be a valid image
"tests/fixtures/valid-image.png" must not be a valid image
- `stdClass {}` must be a valid image
- "tests/fixtures/valid-image.gif" must not be a valid image
