--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::exists()->assert('/path/of/a/non-existent/file'));
exceptionMessage(static fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::exists()->assert('/path/of/a/non-existent/file'));
exceptionFullMessage(static fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"/path/of/a/non-existent/file" must exist
"tests/fixtures/valid-image.gif" must not exist
- "/path/of/a/non-existent/file" must exist
- "tests/fixtures/valid-image.png" must not exist
