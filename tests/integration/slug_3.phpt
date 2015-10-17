--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::slug()->assert('wrong slug');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"wrong slug" must be a valid slug
