--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::allOf(v::stringType(), v::consonant())->assert(42);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- All of the required rules must pass for 42
  - 42 must be of type string
  - 42 must contain only consonants
