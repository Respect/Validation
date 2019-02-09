--CREDITS--
Julián Gutiérrez <juliangut@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::nif()->assert('06357771Q');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- "06357771Q" must be a NIF
