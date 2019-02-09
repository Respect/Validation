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
    v::consonant()->assert('Jaspion');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- "Jaspion" must contain only consonants
