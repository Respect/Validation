# Control

- `Control()`
- `Control(string ...$additionalChars)`

Validates if all of the characters in the provided string, are control
characters.

```php
v::control()->isValid("\n\r\t"); // true
```

## Templates

`Control::TEMPLATE_STANDARD`

| Mode       | Template                                      |
|------------|-----------------------------------------------|
| `default`  | {{name}} must only contain control characters |
| `inverted` | {{name}} must not contain control characters  |

`Control::TEMPLATE_EXTRA`

| Mode       | Template                                                              |
|------------|-----------------------------------------------------------------------|
| `default`  | {{name}} must only contain control characters and {{additionalChars}} |
| `inverted` | {{name}} must not contain control characters or {{additionalChars}}   |

## Template placeholders

| Placeholder       | Description                                                      |
|-------------------|------------------------------------------------------------------|
| `additionalChars` | Additional characters that are considered valid.                 |
| `name`            | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                       |
|--------:|-----------------------------------|
|   2.0.0 | Renamed from `Cntrl` to `Control` |
|   0.5.0 | Created                           |

***
See also:

- [Alnum](Alnum.md)
- [Printable](Printable.md)
- [Punct](Punct.md)
- [Space](Space.md)
