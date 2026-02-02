<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# DateTime

- `DateTime()`
- `DateTime(string $format)`

Validates whether an input is a date/time or not.

The `$format` argument should be in accordance to [DateTime::format()][]. See more in the [Formats](#formats) section.

When a `$format` is not given its default value is `Y-m-d H:i:s`.

```php
v::dateTime()->assert('2009-01-01');
// Validation passes successfully
```

Also accepts [strtotime()](http://php.net/strtotime) values:

```php
v::dateTime()->assert('now');
// Validation passes successfully
```

And `DateTimeInterface` instances:

```php
v::dateTime()->assert(new DateTime());
// Validation passes successfully

v::dateTime()->assert(new DateTimeImmutable());
// Validation passes successfully
```

You can pass a format when validating strings:

```php
v::dateTime('Y-m-d')->assert('01-01-2009');
// → "01-01-2009" must be a date/time in the "2005-12-30" format
```

Format has no effect when validating DateTime instances.

Message template for this validator includes `{{sample}}`.

## Formats

Note that this validator validates whether the input **matches a given [DateTime::format()][] format** and **NOT if the input
can be parsed with a given [DateTimeImmutable::createFromFormat()][] format**. That makes the validation stricter but
offers some limitations.

The way [DateTimeImmutable::createFromFormat()][] parses an input allows for many different conversions. Overall
[DateTimeImmutable::createFromFormat()][] tend to be more lenient than [DateTime::format()][]. This might be what
you desire, and you may want to use [Satisfies](Satisfies.md) to create a custom validation.

```php
$input = '2014-04-12T23:20:50.052Z';

v::satisfies(fn($input) => is_string($input) && DateTime::createFromFormat(DateTime::RFC3339_EXTENDED, $input))
    ->assert($input);
// Validation passes successfully

v::dateTime(DateTime::RFC3339_EXTENDED)->assert($input);
// → "2014-04-12T23:20:50.052Z" must be a date/time in the "2005-12-30T01:02:03.000+00:00" format
```

## Templates

### `DateTime::TEMPLATE_STANDARD`

|       Mode | Template                            |
| ---------: | :---------------------------------- |
|  `default` | {{subject}} must be a date/time     |
| `inverted` | {{subject}} must not be a date/time |

### `DateTime::TEMPLATE_FORMAT`

|       Mode | Template                                                     |
| ---------: | :----------------------------------------------------------- |
|  `default` | {{subject}} must be a date/time in the {{sample}} format     |
| `inverted` | {{subject}} must not be a date/time in the {{sample}} format |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `sample`    |                                                                  |

## Categorization

- Date and Time

## Changelog

| Version | Description                                |
| ------: | :----------------------------------------- |
|   3.0.0 | Templates changed                          |
|   2.3.0 | Validation became a lot stricter           |
|   2.2.4 | `v::dateTime('z')` is no longer supported. |
|   2.0.0 | Created                                    |

## See Also

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [Date](Date.md)
- [DateTimeDiff](DateTimeDiff.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
- [Satisfies](Satisfies.md)
- [Time](Time.md)

[DateTimeImmutable::createFromFormat()]: https://www.php.net/datetimeimmutable.createfromformat
[DateTime::format()]: https://www.php.net/datetime.format
