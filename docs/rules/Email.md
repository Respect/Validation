# Email

- `Email()`

Validates an email address.

```php
v::email()->isValid('alganet@gmail.com'); // true
```



## Templates

`Email::TEMPLATE_STANDARD`

| Mode       | Template                               |
|------------|----------------------------------------|
| `default`  | {{name}} must be a valid email address |
| `inverted` | {{name}} must not be an email address  |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Internet

## Changelog

| Version | Description                                       |
|--------:|---------------------------------------------------|
|   2.3.0 | Use "egulias/emailvalidator" version 4.0          |
|   0.9.0 | Use "egulias/emailvalidator" for email validation |
|   0.3.9 | Created                                           |

***
See also:

- [Json](Json.md)
- [Phone](Phone.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
