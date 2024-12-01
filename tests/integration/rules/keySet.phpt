--FILE--
<?php

require 'vendor/autoload.php';

run([
    'one key() / missing key' => [v::keySet(v::key('foo', v::intType())), []],
    'one key() / single extra key' => [v::keySet(v::key('foo', v::intType())), ['foo' => 42, 'bar' => 'string']],
    'one key() / multiple extra keys' => [v::keySet(v::key('foo', v::intType())), ['foo' => 42, 'bar' => 'string', 'baz' => true]],
    'one key() / failed validation' => [v::keySet(v::key('foo', v::intType())), ['foo' => 'string']],
    'multiple key() / all missing keys' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType())),
        []
    ],
    'multiple key() / single missing key' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType())),
        ['foo' => 42]
    ],
    'multiple key() / single extra key' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType())),
        ['foo' => 42, 'bar' => 'string', 'baz' => true]
    ],
    'multiple key() / multiple extra keys' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType())),
        ['foo' => 42, 'bar' => 'string', 'baz' => true, 'qux' => false]
    ],
    'multiple key() / single failed validation' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType()), v::key('baz', v::intType())),
        ['foo' => 42, 'bar' => 'string', 'baz' => 42]
    ],
    'multiple key() / all failed validation' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType()), v::key('baz', v::intType())),
        ['foo' => 42, 'bar' => 'string', 'baz' => true]
    ],
    'multiple key() / single missing key / single failed validation' => [
        v::keySet(v::key('foo', v::intType()), v::key('bar', v::intType()), v::key('baz', v::intType())),
        ['foo' => 42, 'bar' => 'string']
    ],
]);
?>
--EXPECT--
one key() / missing key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must have keys `["foo"]` in foo
- Must have keys `["foo"]` in foo
[
    'keySet' => 'Must have keys `["foo"]` in foo',
]

one key() / single extra key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must not have keys `["bar"]` in foo
- Must not have keys `["bar"]` in foo
[
    'keySet' => 'Must not have keys `["bar"]` in foo',
]

one key() / multiple extra keys
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must not have keys `["bar", "baz"]` in foo
- Must not have keys `["bar", "baz"]` in foo
[
    'keySet' => 'Must not have keys `["bar", "baz"]` in foo',
]

one key() / failed validation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
foo must be of type integer
- foo must be of type integer
[
    'foo' => 'foo must be of type integer',
]

multiple key() / all missing keys
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must have keys `["foo", "bar"]` in `[]`
- Must have keys `["foo", "bar"]` in `[]`
[
    'keySet' => 'Must have keys `["foo", "bar"]` in `[]`',
]

multiple key() / single missing key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must have keys `["bar"]` in `["foo": 42]`
- Must have keys `["bar"]` in `["foo": 42]`
[
    'keySet' => 'Must have keys `["bar"]` in `["foo": 42]`',
]

multiple key() / single extra key
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must not have keys `["baz"]` in `["foo": 42, "bar": "string", "baz": true]`
- Must not have keys `["baz"]` in `["foo": 42, "bar": "string", "baz": true]`
[
    'keySet' => 'Must not have keys `["baz"]` in `["foo": 42, "bar": "string", "baz": true]`',
]

multiple key() / multiple extra keys
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must not have keys `["baz", "qux"]` in `["foo": 42, "bar": "string", "baz": true, "qux": false]`
- Must not have keys `["baz", "qux"]` in `["foo": 42, "bar": "string", "baz": true, "qux": false]`
[
    'keySet' => 'Must not have keys `["baz", "qux"]` in `["foo": 42, "bar": "string", "baz": true, "qux": false]`',
]

multiple key() / single failed validation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must be of type integer
- These rules must pass for `["foo": 42, "bar": "string", "baz": 42]`
  - bar must be of type integer
[
    'bar' => 'bar must be of type integer',
]

multiple key() / all failed validation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
bar must be of type integer
- These rules must pass for `["foo": 42, "bar": "string", "baz": true]`
  - bar must be of type integer
  - baz must be of type integer
[
    '__root__' => 'These rules must pass for `["foo": 42, "bar": "string", "baz": true]`',
    'bar' => 'bar must be of type integer',
    'baz' => 'baz must be of type integer',
]

multiple key() / single missing key / single failed validation
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Must have keys `["baz"]` in `["foo": 42, "bar": "string"]`
- Must have keys `["baz"]` in `["foo": 42, "bar": "string"]`
[
    'keySet' => 'Must have keys `["baz"]` in `["foo": 42, "bar": "string"]`',
]
