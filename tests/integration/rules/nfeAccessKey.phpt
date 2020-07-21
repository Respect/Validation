--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NfeAccessKeyException;
use Respect\Validation\Validator as v;

try {
    v::nfeAccessKey()->check('31841136830118868211870485416765268625116906');
} catch (NfeAccessKeyException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::nfeAccessKey())->check('52060433009911002506550120000007800267301615');
} catch (NfeAccessKeyException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::nfeAccessKey()->assert('31841136830118868211870485416765268625116906');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::nfeAccessKey())->assert('52060433009911002506550120000007800267301615');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"31841136830118868211870485416765268625116906" must be a valid NFe access key
"52060433009911002506550120000007800267301615" must not be a valid NFe access key
- "31841136830118868211870485416765268625116906" must be a valid NFe access key
- "52060433009911002506550120000007800267301615" must not be a valid NFe access key
