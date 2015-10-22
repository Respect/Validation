--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Rules\Between;
use Respect\Validation\Rules\IntVal;
use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Validator as v;

try {
    v::not(v::when(new IntVal(), new Between(1, 5), new NotEmpty()))->assert(3);
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
- Data validation failed for 3
