--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Test\Stubs\CountableStub;

$input = 'http://www.google.com/search?q=respect.github.com';

exceptionMessage(static function () use ($input): void {
    v::create()
        ->call(
            [new CountableStub(1), 'count'],
            v::arrayVal()->key('scheme', v::startsWith('https'))
        )
        ->assert($input);
});

exceptionMessage(static function () use ($input): void {
    v::create()
        ->call(
            static function ($url) {
                return parse_url($url);
            },
            v::arrayVal()->key('scheme', v::startsWith('https'))
        )
        ->assert($input);
});
?>
--EXPECTF--
1 must be an array value
scheme must start with "https"
