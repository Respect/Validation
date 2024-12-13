--FILE--
<?php

require 'vendor/autoload.php';

exceptionAll('https://github.com/Respect/Validation/issues/1334', static function (): void {
    v::notEmpty()->iterableType()->each(
        v::key('street', v::stringType()->notEmpty())
            ->key('region', v::stringType()->notEmpty())
            ->key('country', v::stringType()->notEmpty())
            ->keyOptional('other', v::nullOr(v::notEmpty()->stringType()))
    )->assert(
        [
            ['region' => 'Oregon', 'country' => 'USA', 'other' => 123],
            ['street' => '', 'region' => 'Oregon', 'country' => 'USA'],
            ['street' => 123, 'region' => 'Oregon', 'country' => 'USA'],
        ]
    );
});

?>
--EXPECT--
https://github.com/Respect/Validation/issues/1334
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
street must be present
- Each item in `[["region": "Oregon", "country": "USA", "other": 123], ["street": "", "region": "Oregon", "country": "USA"], ["s ... ]` must be valid
  - These rules must pass for `["region": "Oregon", "country": "USA", "other": 123]`
    - street must be present
    - These rules must pass for other
      - other must be a string or must be null
  - These rules must pass for `["street": "", "region": "Oregon", "country": "USA"]`
    - street must not be empty
  - These rules must pass for `["street": 123, "region": "Oregon", "country": "USA"]`
    - street must be a string
[
    'each' => [
        '__root__' => 'Each item in `[["region": "Oregon", "country": "USA", "other": 123], ["street": "", "region": "Oregon", "country": "USA"], ["s ... ]` must be valid',
        'allOf.1' => [
            '__root__' => 'These rules must pass for `["region": "Oregon", "country": "USA", "other": 123]`',
            'street' => 'street must be present',
            'other' => 'other must be a string or must be null',
        ],
        'allOf.2' => 'street must not be empty',
        'allOf.3' => 'street must be a string',
    ],
]
