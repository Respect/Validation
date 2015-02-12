# Key

- `v::key(string $name)`
- `v::key(string $name, v $validator)`
- `v::key(string $name, v $validator, boolean $mandatory = true)`

Validates an array key.

```php
$dict = array(
    'foo' => 'bar'
);

v::key('foo')->validate($dict); //true
```

You can also validate the key value itself:

```php
v::key('foo', v::equals('bar'))->validate($dict); //true
```

Third parameter makes the key presence optional:

```php
v::key('lorem', v::string(), false)->validate($dict); // true
```

The name of this validator is automatically set to the key name.

See also:

  * [Attribute](Attribute.md)
