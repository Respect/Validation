--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Marcel dos Santos <marcelgsantos@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::slug()->assert('wrong slug');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- "wrong slug" must be a valid slug
