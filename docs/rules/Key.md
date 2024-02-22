# Key

- `Key(int|string $key, Validatable $rule)`

Validates the value of an array against a given rule.

```php
v::key('name', v::stringType())->validate(['name' => 'The Respect Panda']); // true

v::key('email', v::email())->validate(['email' => 'therespectpanda@gmail.com']); // true

v::key('age', v::intVal())->validate([]); // false
```

The name of this validator is automatically set to the key name.

```php
v::key('email', v::email())->assert([]);
// message: email must be present

v::key('email', v::email())->assert(['email' => 'not email']);
// message: email must be valid email
```

## Note

* To validate if a key exists, use [KeyExists](KeyExists.md) instead.
* To validate an array against a given rule if the key exists, use [KeyOptional](KeyOptional.md) instead.

## Categorization

- Arrays
- Nesting
- Structures

## Changelog

| Version | Description                                                          |
|--------:|----------------------------------------------------------------------|
|   3.0.0 | Split by [KeyExists](KeyExists.md) and [KeyOptional](KeyOptional.md) |
|   0.3.9 | Created                                                              |

***
See also:

- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [KeyExists](KeyExists.md)
- [KeyNested](KeyNested.md)
- [KeyOptional](KeyOptional.md)
- [KeySet](KeySet.md)
- [Property](Property.md)
