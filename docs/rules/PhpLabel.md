# PhpLabel

- `PhpLabel()`

Validates if a value is considered a valid PHP Label,
so that it can be used as a _variable_, _function_ or _class_ name, for example.

Reference:
http://php.net/manual/en/language.variables.basics.php

```php
v::phpLabel()->isValid('person'); //true
v::phpLabel()->isValid('foo'); //true
v::phpLabel()->isValid('4ccess'); //false
```

## Templates

### `PhpLabel::TEMPLATE_STANDARD`

| Mode       | Template                                  |
| ---------- | ----------------------------------------- |
| `default`  | {{subject}} must be a valid PHP label     |
| `inverted` | {{subject}} must not be a valid PHP label |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.1.0 | Created     |

---

See also:

- [Charset](Charset.md)
- [Regex](Regex.md)
- [ResourceType](ResourceType.md)
- [Slug](Slug.md)
