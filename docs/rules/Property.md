# Property

- `Property(string $name)`
- `Property(string $name, Validatable $rule)`
- `Property(string $name, Validatable $rule, bool $mandatory)`

Validates an object property, even private ones.

```php
$obj = new stdClass;
$obj->foo = 'bar';

v::property('foo')->validate($obj); // true
```

You can also validate the property itself:

```php
v::property('foo', v::equals('bar'))->validate($obj); // true
```

Third parameter makes the property presence optional:

```php
v::property('lorem', v::stringType(), false)->validate($obj); // true
```

The name of this validator is automatically set to the property name.

## Categorization

- Nesting
- Objects
- Structures

## Changelog

Version | Description
--------|-------------
  3.0.0 | Renamed from `Attribute` to `Property`
  0.3.9 | Created

***
See also:

- [Key](Key.md)
- [KeyNested](KeyNested.md)
- [ObjectType](ObjectType.md)
