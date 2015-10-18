--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\YesException;
use Respect\Validation\Validator as v;

try {
    v::yes()->check('si');
} catch (YesException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"si" is not considered as "Yes"
