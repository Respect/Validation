# Uppercase

- `Uppercase()`

Validates whether the characters in the input are uppercase.

```php
v::uppercase()->isValid('W3C'); // true
```

This rule does not validate if the input a numeric value, so `123` and `%` will
be valid. Please add more validations to the chain if you want to refine your
validation.

```php
v::not(v::numericVal())->uppercase()->isValid('42'); // false
v::alnum()->uppercase()->isValid('#$%!'); // false
v::not(v::numericVal())->alnum()->uppercase()->isValid('W3C'); // true
```

## Templates

### `Uppercase::TEMPLATE_STANDARD`

| Mode       | Template                                         |
|------------|--------------------------------------------------|
| `default`  | {{name}} must contain only uppercase letters     |
| `inverted` | {{name}} must not contain only uppercase letters |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Lowercase](Lowercase.md)
- [NumericVal](NumericVal.md)
- [Roman](Roman.md)
