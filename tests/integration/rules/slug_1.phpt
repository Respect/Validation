--CREDITS--
Marcel dos Santos <marcelgsantos@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::slug()->check('getting-started-to-respect-validation');
v::slug()->assert('welcome-to-php-7');
?>
--EXPECT--
