# Equals

- `Equals(mixed $compareTo)`

Validates if the input is equal to some value.

```php
v::equals('alganet')->isValid('alganet'); // true
```

Message template for this validator includes `{{compareTo}}`.

## Templates

### `Equals::TEMPLATE_STANDARD`

| Mode       | Template                                       |
| ---------- | ---------------------------------------------- |
| `default`  | {{subject}} must be equal to {{compareTo}}     |
| `inverted` | {{subject}} must not be equal to {{compareTo}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `compareTo` | Value to be compared against the input.                          |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description                                                |
| ------: | ---------------------------------------------------------- |
|   1.0.0 | Removed identical checking (see [Identical](Identical.md)) |
|   0.3.9 | Created                                                    |

---

See also:

- [Contains](Contains.md)
- [Equivalent](Equivalent.md)
- [Identical](Identical.md)
- [Version](Version.md)
