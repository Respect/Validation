# KeyOptional

- `KeyOptional(int|string $key, Rule $rule)`

Validates the value of an array against a given rule when the key exists.

```php
v::keyOptional('name', v::stringType())->isValid([]); // true
v::keyOptional('name', v::stringType())->isValid(['name' => 'The Respect Panda']); // true

v::keyOptional('email', v::email())->isValid([]); // true
v::keyOptional('email', v::email())->isValid(['email' => 'therespectpanda@gmail.com']); // true

v::keyOptional('age', v::intVal())->isValid(['age' => 'Twenty-Five']); // false
```

The name of this validator is automatically set to the key name.

```php
v::keyOptional('age', v::intVal())->assert(['age' => 'Twenty-Five']);
// message: age must be an integer number
```

## Note

This rule will pass for anything that is not an array because it will always pass when it doesn't find a key. If you
want to ensure the input is an array, use [ArrayType](ArrayType.md) with it.

```php
v::arrayType()->keyOptional('phone', v::phone())->assert('This is not an array');
// message: "This is not an array" must be of type array
```

Below are some other rules that are tightly related to `KeyOptional`:

* To validate if a key exists, use [KeyExists](KeyExists.md) instead.
* To validate an array against a given rule requiring the key to exist, use [Key](Key.md) instead.

## Templates

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Structures

## Changelog

| Version | Description                |
|--------:|----------------------------|
|   3.0.0 | Created from [Key](Key.md) |

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [Key](Key.md)
- [KeyExists](KeyExists.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)

[array]: https://www.php.net/array
[ArrayAccess]: https://www.php.net/arrayaccess
