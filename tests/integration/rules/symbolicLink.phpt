--FILE--
<?php
namespace Respect\Validation\Rules;

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\SymbolicLinkException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

$GLOBALS['is_link'] = null;

// This override is only needed for the test, since 
// symbolic links cannot be mocked properly in PHP.
// See this issue for more info: https://github.com/mikey179/vfsStream/issues/89
function is_link($link)
{
    $return = \is_link($link);
    if (null !== $GLOBALS['is_link']) {
        $return = $GLOBALS['is_link'];
        $GLOBALS['is_link'] = null;
    }

    return $return;
}

try {
    $GLOBALS['is_link'] = false;
    v::symbolicLink()->check('/path/of/invalid/symbolic/link');
} catch (SymbolicLinkException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    $GLOBALS['is_link'] = true;
    v::not(v::symbolicLink())->check('/path/of/valid/symbolic/link');
} catch (SymbolicLinkException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    $GLOBALS['is_link'] = false;
    v::symbolicLink()->assert('/path/of/invalid/symbolic/link');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    $GLOBALS['is_link'] = true;
    v::not(v::symbolicLink())->assert('/path/of/valid/symbolic/link');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"/path/of/invalid/symbolic/link" must be a symbolic link
"/path/of/valid/symbolic/link" must not be a symbolic link
- "/path/of/invalid/symbolic/link" must be a symbolic link
- "/path/of/valid/symbolic/link" must not be a symbolic link

