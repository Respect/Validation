--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Rules\AbstractRule;

class MyRule extends AbstractRule
{
    public function validate($input): bool
    {
        return false;
    }
}

$myRule = new MyRule();
$myRule->assert('anything');

?>
--EXPECT--
