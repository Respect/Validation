--FILE--
<?php


require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

class MyClass
{
    public function parse($url)
    {
        return parse_url($url);
    }
}

$input = 'http://www.google.com/search?q=respect.github.com';

try {
    v::create()
        ->call(
            [new MyClass(), 'parse'],
            v::arrayVal()->key('scheme', v::startsWith('https'))
        )
        ->assert($input);
} catch (AllOfException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::create()
        ->call(
            function ($url) {
                return parse_url($url);
            },
            v::arrayVal()->key('scheme', v::startsWith('https'))
        )
        ->assert($input);
} catch (AllOfException $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
All of the required rules must pass for "http://www.google.com/search?q=respect.github.com"
All of the required rules must pass for "http://www.google.com/search?q=respect.github.com"
