# NoWhitespace

- `NoWhitespace()`

Validates if a string contains no whitespace (spaces, tabs and line breaks);

```php
v::noWhitespace()->isValid('foo bar');  //false
v::noWhitespace()->isValid("foo\nbar"); // false
```

This is most useful when chaining with other validators such as `Alnum()`

## Templates

### `NoWhitespace::TEMPLATE_STANDARD`

| Mode       | Template                                         |
| ---------- | ------------------------------------------------ |
| `default`  | {{subject}} must not contain whitespaces         |
| `inverted` | {{subject}} must contain at least one whitespace |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Blank](Blank.md)
- [CreditCard](CreditCard.md)
- [NotEmpty](NotEmpty.md)
- [Undef](Undef.md)
- [UndefOr](UndefOr.md)
