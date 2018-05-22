--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\SlugException;
use Respect\Validation\Validator as v;

try {
    v::slug()->check('wrong slug');
} catch (SlugException $e) {
    echo $e->getMessage();
}

?>
--EXPECTF--
"wrong slug" must be a valid slug