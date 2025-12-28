# Spaced

- `Spaced()`

Validates if a string contains at least one whitespace (spaces, tabs, or line breaks);

```php
v::spaced()->isValid('foo bar'); // true
v::spaced()->isValid("foo\nbar"); // true
```

This is most useful when inverting the validator as `notSpaced()`, and chaining with other validators such as [Alnum](Alnum.md) or [Alpha](Alpha.md) to ensure that a string contains no whitespace characters:

```php
v::notSpaced()->alnum()->isValid('username'); // true
v::notSpaced()->alnum()->isValid('user name'); // false
```

## Templates

### `Spaced::TEMPLATE_STANDARD`

| Mode       | Template                                         |
| ---------- | ------------------------------------------------ |
| `default`  | {{subject}} must contain at least one whitespace |
| `inverted` | {{subject}} must not contain whitespaces         |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                                  |
| ------: | -------------------------------------------- |
|   3.0.0 | Renamed to `Spaced` and changed the behavior |
|   0.3.9 | Created as `NoWhitespace`                    |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Blank](Blank.md)
- [CreditCard](CreditCard.md)
- [NotEmpty](NotEmpty.md)
- [Undef](Undef.md)
- [UndefOr](UndefOr.md)
