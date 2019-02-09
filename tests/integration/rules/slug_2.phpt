--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Marcel dos Santos <marcelgsantos@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\SlugException;
use Respect\Validation\Validator as v;

try {
    v::slug()->check('wrong slug');
} catch (SlugException $e) {
    echo $e->getMessage();
}

?>
--EXPECT--
"wrong slug" must be a valid slug