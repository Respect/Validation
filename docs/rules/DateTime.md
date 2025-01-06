# DateTime

- `DateTime()`
- `DateTime(string $format)`

Validates whether an input is a date/time or not.

The `$format` argument should be in accordance to [DateTime::format()][]. See more in the [Formats](#formats) section.

When a `$format` is not given its default value is `Y-m-d H:i:s`.

```php
v::dateTime()->isValid('2009-01-01'); // true
```

Also accepts [strtotime()](http://php.net/strtotime) values:

```php
v::dateTime()->isValid('now'); // true
```

And `DateTimeInterface` instances:

```php
v::dateTime()->isValid(new DateTime()); // true
v::dateTime()->isValid(new DateTimeImmutable()); // true
```

You can pass a format when validating strings:

```php
v::dateTime('Y-m-d')->isValid('01-01-2009'); // false
```

Format has no effect when validating DateTime instances.

Message template for this validator includes `{{sample}}`.

## Formats

Note that this rule validates whether the input **matches a given [DateTime::format()][] format** and **NOT if the input
can be parsed with a given [DateTimeImmutable::createFromFormat()][] format**. That makes the validation stricter but
offers some limitations.

The way [DateTimeImmutable::createFromFormat()][] parses an input allows for many different conversions. Overall
[DateTimeImmutable::createFromFormat()][] tend to be more lenient than [DateTime::format()][]. This might be what
you desire, and you may want to use [Callback](Callback.md) to create a custom validation.

```php
$input = '2014-04-12T23:20:50.052Z';

v::callback(fn($input) => is_string($input) && DateTime::createFromFormat(DateTime::RFC3339_EXTENDED, $input))
    ->isValid($input); // true

v::dateTime(DateTime::RFC3339_EXTENDED)->isValid($input); // false
```

## Categorization

- Date and Time

## Changelog

| Version | Description                                |
|---------|--------------------------------------------|
| 2.3.0   | Validation became a lot stricter           |
| 2.2.4   | `v::dateTime('z')` is no longer supported. |
| 2.0.0   | Created                                    |

***
See also:

- [Between](Between.md)
- [Callback](Callback.md)
- [Date](Date.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
- [MinAge](MinAge.md)
- [Time](Time.md)

[DateTimeImmutable::createFromFormat()]: https://www.php.net/datetimeimmutable.createfromformat
[DateTime::format()]: https://www.php.net/datetime.format
