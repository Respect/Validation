--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Marcel dos Santos <marcelgsantos@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SlugException;
use Respect\Validation\Validator as v;

try {
    v::slug()->check('myBlog-test');
} catch (SlugException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::slug())->check('o-rato-roeu-o-rei-de-roma');
} catch (SlugException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::slug()->assert('á-é-í-ó-ú');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::slug())->assert('anticonstitucionalissimamente');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"myBlog-test" must be a valid slug
"o-rato-roeu-o-rei-de-roma" must not be a valid slug
- "á-é-í-ó-ú" must be a valid slug
- "anticonstitucionalissimamente" must not be a valid slug