--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::file()->assert('tests/fixtures/non-existent.sh'));
exceptionMessage(static fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::file()->assert('tests/fixtures/non-existent.sh'));
exceptionFullMessage(static fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"tests/fixtures/non-existent.sh" must be a valid file
"tests/fixtures/valid-image.png" must be an invalid file
- "tests/fixtures/non-existent.sh" must be a valid file
- "tests/fixtures/valid-image.png" must be an invalid file