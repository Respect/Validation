--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Test\Stubs\CountableStub;

$input = 'http://www.google.com/search?q=respect.github.com';

exceptionAll('https://github.com/Respect/Validation/issues/799', static function () use ($input): void {
    v::create()
        ->call(
            [new CountableStub(1), 'count'],
            v::arrayVal()->key('scheme', v::startsWith('https'))
        )
        ->assert($input);
});

exceptionAll('https://github.com/Respect/Validation/issues/799', static function () use ($input): void {
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
--EXPECT--
https://github.com/Respect/Validation/issues/799
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
1 must be an array value
- All of the required rules must pass for 1
  - 1 must be an array value
  - scheme must be present
[
    '__root__' => 'All of the required rules must pass for 1',
    'arrayVal' => '1 must be an array value',
    'scheme' => 'scheme must be present',
]

https://github.com/Respect/Validation/issues/799
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
scheme must start with "https"
- These rules must pass for `["scheme": "http", "host": "www.google.com", "path": "/search", "query": "q=respect.github.com"]`
  - scheme must start with "https"
[
    'scheme' => 'scheme must start with "https"',
]
