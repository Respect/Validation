--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\SlugException;
use Respect\Validation\Validator as v;

try {
    v::not(v::slug())->assert('good-and-valid-slug');
} catch (SlugException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"good-and-valid-slug" must not be a valid slug
