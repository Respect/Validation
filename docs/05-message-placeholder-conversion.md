# Message placeholder conversion

Messages in Validation usually have placeholders that are in between "{{" and
"}}" characters. To replace those placeholders with the real parameters, we need
to convert them to string.

We use the `ParameterStringifier` to convert those parameters into a string.
Our default implementation will convert all parameters with
[Respect\Stringifier](https://github.com/Respect/Stringifier) unless the
parameter is called `name` and it is already a string.

It is possible to overwrite that behavior by creating a custom implementation of
the parameter stringifier. However, this requires advanced knowledge of the
internal architecture and is not commonly needed.

For most use cases, the default stringifier should be sufficient.

## Locale-aware placeholder conversion

Version 3.0 introduces locale-aware formatting for numeric and date placeholders:

```php
use Respect\Validation\Validator as v;

// Set locale for proper formatting
setlocale(LC_ALL, 'en_US.UTF-8');

$validator = v::between(1000, 2000);

try {
    $validator->assert(500);
} catch (ValidationException $exception) {
    // In en_US: "500 must be between 1,000 and 2,000"
    echo $exception->getMessage();
}

// Change locale to German
setlocale(LC_ALL, 'de_DE.UTF-8');

try {
    $validator->assert(500);
} catch (ValidationException $exception) {
    // In de_DE: "500 must be between 1.000 and 2.000"
    echo $exception->getMessage();
}
```

## Date and time formatting with locales

Date and time values are also formatted according to the current locale:

```php
use Respect\Validation\Validator as v;

// Set locale for date formatting
setlocale(LC_TIME, 'en_US.UTF-8');

$validator = v::minAge(18);

try {
    $validator->assert(new DateTime('2020-01-01'));
} catch (ValidationException $exception) {
    // In en_US: "2020-01-01 must be older than 18 years"
    echo $exception->getMessage();
}

// Change locale to French
setlocale(LC_TIME, 'fr_FR.UTF-8');

try {
    $validator->assert(new DateTime('2020-01-01'));
} catch (ValidationException $exception) {
    // In fr_FR: "2020-01-01 must be older than 18 ans"
    echo $exception->getMessage();
}
```

## New placeholder filter syntax

Version 3.0 introduces a new placeholder filter syntax with the `|quote` filter for quoted values:

```php
use Respect\Validation\Validator as v;

// Using the new quote filter in custom templates
$message = '{{name|quote}} must be a valid email address';
$validator = v::email()->assert('invalid@example.com', $message);

// The |quote filter will properly quote values for better readability
// For example, if the input is "user@example", the message becomes:
// '"user@example" must be a valid email address'
```

## Available filters

- `|quote`: Surrounds the parameter value with quotes for better readability
- More filters may be added in future versions

## Custom parameter stringification

You can create custom stringifiers to handle specific parameter types. This
requires implementing the `Stringifier` interface from the Respect\Stringifier
package:

```php
// Custom stringifier implementation
// (This is an advanced feature that requires deep knowledge of the internals)
final class MyCustomStringifier
{
    // Implementation details would go here
}
```
