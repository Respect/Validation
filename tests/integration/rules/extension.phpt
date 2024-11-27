--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::extension('png')->assert('filename.txt'));
exceptionMessage(static fn() => v::not(v::extension('gif'))->assert('filename.gif'));
exceptionFullMessage(static fn() => v::extension('mp3')->assert('filename.wav'));
exceptionFullMessage(static fn() => v::not(v::extension('png'))->assert('tests/fixtures/invalid-image.png'));
?>
--EXPECT--
"filename.txt" must have "png" extension
"filename.gif" must not have "gif" extension
- "filename.wav" must have "mp3" extension
- "tests/fixtures/invalid-image.png" must not have "png" extension
