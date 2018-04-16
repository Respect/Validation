# Attribute

- `Attribute(string $name)`
- `Attribute(string $name, Validatable $rule)`
- `Attribute(string $name, Validatable $rule, bool $mandatory)`

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

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Key](Key.md)
