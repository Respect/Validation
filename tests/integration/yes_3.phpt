--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\YesException;

try {
    v::yes()->check(null);
} catch (YesException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
null is not considered as "Yes"
