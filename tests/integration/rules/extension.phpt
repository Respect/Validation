--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::extension('png')->check('filename.txt'));
exceptionMessage(static fn() => v::not(v::extension('gif'))->check('filename.gif'));
exceptionFullMessage(static fn() => v::extension('mp3')->assert('filename.wav'));
exceptionFullMessage(static fn() => v::not(v::extension('png'))->assert('tests/fixtures/invalid-image.png'));
?>
--EXPECT--
"filename.txt" must have "png" extension
"filename.gif" must not have "gif" extension
- "filename.wav" must have "mp3" extension
- "tests/fixtures/invalid-image.png" must not have "png" extension
