--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::mimetype('image/png')->check('image.png'));
exceptionMessage(static fn() => v::not(v::mimetype('image/png'))->check('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::mimetype('image/png')->assert('tests/fixtures/invalid-image.png'));
exceptionFullMessage(static fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"image.png" must have "image/png" MIME type
"tests/fixtures/valid-image.png" must not have "image/png" MIME type
- "tests/fixtures/invalid-image.png" must have "image/png" MIME type
- "tests/fixtures/valid-image.png" must not have "image/png" MIME type
