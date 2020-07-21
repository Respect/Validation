--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ExtensionException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::extension('png')->check('filename.txt');
} catch (ExtensionException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::extension('gif'))->check('filename.gif');
} catch (ExtensionException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::extension('mp3')->assert('filename.wav');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::extension('png'))->assert('tests/fixtures/invalid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"filename.txt" must have "png" extension
"filename.gif" must not have "gif" extension
- "filename.wav" must have "mp3" extension
- "tests/fixtures/invalid-image.png" must not have "png" extension
