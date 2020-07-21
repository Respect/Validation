--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BoolValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::boolVal()->check('ok');
} catch (BoolValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::boolVal())->check('yes');
} catch (BoolValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::boolVal()->assert('yep');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::boolVal())->assert('on');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"ok" must be a boolean value
"yes" must not be a boolean value
- "yep" must be a boolean value
- "on" must not be a boolean value
