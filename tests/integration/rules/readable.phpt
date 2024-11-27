--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::readable()->assert('tests/fixtures/invalid-image.jpg'));
exceptionMessage(static fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::readable()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"tests/fixtures/invalid-image.jpg" must be readable
"tests/fixtures/valid-image.png" must not be readable
- `stdClass {}` must be readable
- "tests/fixtures/valid-image.png" must not be readable
