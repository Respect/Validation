--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::mimetype('image/png')->assert('image.png'));
exceptionMessage(static fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::mimetype('image/png')->assert('tests/fixtures/invalid-image.png'));
exceptionFullMessage(static fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"image.png" must have the "image/png" MIME type
"tests/fixtures/valid-image.png" must not have the "image/png" MIME type
- "tests/fixtures/invalid-image.png" must have the "image/png" MIME type
- "tests/fixtures/valid-image.png" must not have the "image/png" MIME type