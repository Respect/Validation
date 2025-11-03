# Message placeholder conversion

Messages in Validation usually have placeholders that are in between "{{" and
"}}" characters. To replace those placeholders with the real parameters, we need
to convert them to string.

We use the `ParameterStringifier` to convert those parameters into a string.
Our default implementation will convert all parameters with
[Respect\Stringifier](https://github.com/Respect/Stringifier) unless the
parameter is called `name` and it is already a string.

It is possible to overwrite that behavior by creating a custom implementation of
the `ParameterStringifier` and passing it to the `Factory`:

```php
Factory::setDefaultInstance(
    (new Factory())->withParameterStringifier(new MyCustomStringifier())
);
```

## New placeholder filter syntax

Version 3.0 introduces a new placeholder filter syntax with the `|quote` filter for quoted values:

```php
use Respect\Validation\Validator as v;

// Using the new quote filter in custom templates
$message = '{{name|quote}} must be a valid email address';
$validator = v::email()->assert($input, $message);

// The |quote filter will properly quote values for better readability
// For example, if the input is "user@example", the message becomes:
// '"user@example" must be a valid email address'
```

## Available filters

- `|quote`: Surrounds the parameter value with quotes for better readability
- More filters may be added in future versions

## Custom parameter stringification

You can create custom stringifiers to handle specific parameter types:

```php
use Respect\Validation\Message\ParameterStringifier;

final class MyCustomStringifier implements ParameterStringifier
{
    public function stringify(string $name, mixed $value): string
    {
        // Custom logic for converting parameters to strings
        if ($name === 'sensitiveData') {
            return '[REDACTED]';
        }
        
        return (string) $value;
    }
}
```
