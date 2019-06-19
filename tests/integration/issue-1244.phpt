--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

try {
    v::key('firstname', v::notBlank()->setName('First Name'))->check([]);
} catch (\Exception $e) {
    print_r($e->getMessages());
}

?>
--EXPECTF--
Array
(
    [0] => Key First Name must be present
)