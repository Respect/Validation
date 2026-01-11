# Instance

- `Instance(class-string $class)`

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->isValid(new DateTime); // true
v::instance('Traversable')->isValid(new ArrayObject); // true
```

Message template for this validator includes `{{instanceName}}`.

## Templates

### `Instance::TEMPLATE_STANDARD`

| Mode       | Template                                                    |
| ---------- | ----------------------------------------------------------- |
| `default`  | {{subject}} must be an instance of {{class&#124;quote}}     |
| `inverted` | {{subject}} must not be an instance of {{class&#124;quote}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `class`     |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Objects

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Countable](Countable.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [ObjectType](ObjectType.md)
- [Type](Type.md)
