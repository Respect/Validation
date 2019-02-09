--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Marcel dos Santos <marcelgsantos@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::slug())->assert('good-and-valid-slug');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
- "good-and-valid-slug" must not be a valid slug
