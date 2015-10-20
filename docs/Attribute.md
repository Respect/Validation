# Attribute

- `v::attribute(string $name)`
- `v::attribute(string $name, v $validator)`
- `v::attribute(string $name, v $validator, boolean $mandatory = true)`

Validates an object attribute.

```php
$obj = new stdClass;
$obj->foo = 'bar';

v::attribute('foo')->validate($obj); // true
```

You can also validate the attribute itself:

```php
v::attribute('foo', v::equals('bar'))->validate($obj); // true
```

Third parameter makes the attribute presence optional:

```php
v::attribute('lorem', v::stringType(), false)->validate($obj); // true
```

The name of this validator is automatically set to the attribute name.

***
See also:

  * [Key](Key.md)
