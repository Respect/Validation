--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\SlugException;

try {
    v::not(v::slug())->check('good-and-valid-slug');
} catch (SlugException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"good-and-valid-slug" must not be a valid slug
