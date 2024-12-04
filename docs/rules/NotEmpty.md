# NotEmpty

- `NotEmpty()`

Validates wether the given input is not empty. This function also takes whitespace
into account, use `noWhitespace()` if no spaces or linebreaks and other
whitespace anywhere in the input is desired.

```php
v::stringType()->notEmpty()->isValid(''); // false
```

Null values are empty:

```php
v::notEmpty()->isValid(null); // false
```

Numbers:

```php
v::intVal()->notEmpty()->isValid(0); // false
```

Empty arrays:

```php
v::arrayVal()->notEmpty()->isValid([]); // false
```

Whitespace:

```php
v::stringType()->notEmpty()->isValid('        ');  //false
v::stringType()->notEmpty()->isValid("\t \n \r");  //false
```

## Templates

`NotEmpty::TEMPLATE_STANDARD`

| Mode       | Template                    |
|------------|-----------------------------|
| `default`  | The value must not be empty |
| `inverted` | The value must be empty     |

`NotEmpty::TEMPLATE_NAMED`

| Mode       | Template                   |
|------------|----------------------------|
| `default`  | {{name}} must not be empty |
| `inverted` | {{name}} must be empty     |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description |
|--------:|-------------|
|   0.3.9 | Created     |

***
See also:

- [Each](Each.md)
- [Max](Max.md)
- [Min](Min.md)
- [NoWhitespace](NoWhitespace.md)
- [NotBlank](NotBlank.md)
- [NotUndef](NotUndef.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
