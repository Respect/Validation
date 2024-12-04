--FILE--
<?php

require 'vendor/autoload.php';

run([
    'one rule / one failed' => [v::keySet(v::key('foo', v::intType())), ['foo' => 'string']],
    'one rule / one missing key' => [v::keySet(v::keyExists('foo')), []],
    'one rule / one extra key' => [v::keySet(v::keyExists('foo')), ['foo' => 42, 'bar' => 'string']],
    'one rule / one extra key / one missing key' => [v::keySet(v::keyExists('foo')), ['bar' => true]],
    'one rule / two extra keys' => [v::keySet(v::keyExists('foo')), ['foo' => 42, 'bar' => 'string', 'baz' => true]],
    'one rule / more than ten extra keys' => [
        v::keySet(v::keyExists('foo')),
        [
            'foo' => 42,
            'bar' => 'string',
            'baz' => true,
            'qux' => false,
            'quux' => 42,
            'corge' => 'string',
            'grault' => true,
            'garply' => false,
            'waldo' => 42,
            'fred' => 'string',
            'plugh' => true,
            'xyzzy' => false,
            'thud' => 42,
        ],
    ],
    'multiple rules / one failed' => [
        v::keySet(v::keyExists('foo'), v::keyExists('bar')),
        ['foo' => 42],
    ],
    'multiple rules / all failed' => [
        v::keySet(v::keyExists('foo'), v::keyExists('bar')),
        [],
    ],
    'multiple rules / one extra key' => [
        v::keySet(v::keyExists('foo'), v::keyExists('bar')),
        ['foo' => 42, 'bar' => 'string', 'baz' => true],
    ],
    'multiple rules / one extra key / one missing' => [
        v::keySet(
            v::keyExists('foo'),
            v::keyExists('bar')
        ),
        ['bar' => 'string', 'baz' => true],
    ],
    'multiple rules / two extra keys' => [
        v::keySet(
            v::keyExists('foo'),
            v::keyExists('bar'),
            v::keyOptional('qux', v::intType())
        ),
        ['foo' => 42, 'bar' => 'string', 'baz' => true, 'qux' => false],
    ],
    'multiple rules / all failed validation' => [
        v::keySet(
            v::key('foo', v::intType()),
            v::key('bar', v::intType()),
            v::key('baz', v::intType())
        ),
        ['foo' => 42, 'bar' => 'string', 'baz' => true],
    ],
    'multiple rules / single missing key / single failed validation' => [
        v::keySet(
            v::create()
                ->key('foo', v::intType())
                ->key('bar', v::intType())
                ->key('baz', v::intType())
        ),
        ['foo' => 42, 'bar' => 'string'],
    ],
]);
?>
--EXPECT--
one rule / one failed
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be an integer
- `["foo": "string"]` validation failed
  - foo must be an integer
[
    'foo' => 'foo must be an integer',
]

one rule / one missing key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- foo must be present
[
    'foo' => 'foo must be present',
]

one rule / one extra key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must not be present
- bar must not be present
[
    'bar' => 'bar must not be present',
]

one rule / one extra key / one missing key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- `["bar": true]` contains both missing and extra keys
  - foo must be present
  - bar must not be present
[
    '__root__' => '`["bar": true]` contains both missing and extra keys',
    'foo' => 'foo must be present',
    'bar' => 'bar must not be present',
]

one rule / two extra keys
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must not be present
- `["foo": 42, "bar": "string", "baz": true]` contains extra keys
  - bar must not be present
  - baz must not be present
[
    '__root__' => '`["foo": 42, "bar": "string", "baz": true]` contains extra keys',
    'bar' => 'bar must not be present',
    'baz' => 'baz must not be present',
]

one rule / more than ten extra keys
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must not be present
- `["foo": 42, "bar": "string", "baz": true, "qux": false, "quux": 42, ...]` contains extra keys
  - bar must not be present
  - baz must not be present
  - qux must not be present
  - quux must not be present
  - corge must not be present
  - grault must not be present
  - garply must not be present
  - waldo must not be present
  - fred must not be present
  - plugh must not be present
[
    '__root__' => '`["foo": 42, "bar": "string", "baz": true, "qux": false, "quux": 42, ...]` contains extra keys',
    'bar' => 'bar must not be present',
    'baz' => 'baz must not be present',
    'qux' => 'qux must not be present',
    'quux' => 'quux must not be present',
    'corge' => 'corge must not be present',
    'grault' => 'grault must not be present',
    'garply' => 'garply must not be present',
    'waldo' => 'waldo must not be present',
    'fred' => 'fred must not be present',
    'plugh' => 'plugh must not be present',
]

multiple rules / one failed
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must be present
- bar must be present
[
    'bar' => 'bar must be present',
]

multiple rules / all failed
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- `[]` contains missing keys
  - foo must be present
  - bar must be present
[
    '__root__' => '`[]` contains missing keys',
    'foo' => 'foo must be present',
    'bar' => 'bar must be present',
]

multiple rules / one extra key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
baz must not be present
- baz must not be present
[
    'baz' => 'baz must not be present',
]

multiple rules / one extra key / one missing
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be present
- `["bar": "string", "baz": true]` contains both missing and extra keys
  - foo must be present
  - baz must not be present
[
    '__root__' => '`["bar": "string", "baz": true]` contains both missing and extra keys',
    'foo' => 'foo must be present',
    'baz' => 'baz must not be present',
]

multiple rules / two extra keys
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
qux must be an integer
- qux must be an integer
- baz must not be present
[
    '__root__' => '`["foo": 42, "bar": "string", "baz": true, "qux": false]` contains extra keys',
    'qux' => 'qux must be an integer',
    'baz' => 'baz must not be present',
]

multiple rules / all failed validation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must be an integer
- `["foo": 42, "bar": "string", "baz": true]` validation failed
  - bar must be an integer
  - baz must be an integer
[
    '__root__' => '`["foo": 42, "bar": "string", "baz": true]` validation failed',
    'bar' => 'bar must be an integer',
    'baz' => 'baz must be an integer',
]

multiple rules / single missing key / single failed validation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must be an integer
- bar must be an integer
- baz must be present
[
    '__root__' => '`["foo": 42, "bar": "string"]` contains missing keys',
    'bar' => 'bar must be an integer',
    'baz' => 'baz must be present',
]
