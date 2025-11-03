# Custom rules

You can also create and use your own rules. To do this, you will need to create
a rule and an exception to go with the rule.

To create a rule, you need to create a class that implements the `Rule` interface
and is within the Rules `namespace`. It is convenient to just extend the `Simple` or
`Standard` class. When the rule is called the logic inside the validate method will be
executed. Here's how the class should look:

```php
namespace My\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Template(
    '{{name}} is something',
    '{{name}} is not something',
)]
final class Something extends Simple
{
    protected function isValid(mixed $input): bool
    {
        // Do something here with the $input and return a boolean value
    }
}
```

The `'{{name}} is not something` message would be used when you call the rule
with the `not()`.

All classes in Validation are created by the `Factory` class. If you want
Validation to execute your rule (or rules) in the chain, you must overwrite the
default `Factory`.

```php
Factory::setDefaultInstance(
    (new Factory())
        ->withRuleNamespace('My\\Validation\\Rules')
);
v::something(); // Try to load "My\Validation\Rules\Something" if any
```

## Using Custom Rules as Attributes

Version 3.0 supports using custom rules as PHP 8+ attributes. To make your custom rule work as an attribute, ensure it uses the `#[Template]` attribute as shown above.

```php
use Respect\Validation\Rules\Email;

class User
{
    #[Email]
    #[Something] // Your custom rule as an attribute
    public string $email;
}

// Validate all attributed properties
v::attributes()->assert($user);
```

## Custom Rules with Parameters

If your custom rule needs parameters, you can add them to the constructor:

```php
namespace My\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Template(
    '{{name}} must be between {{min}} and {{max}}',
    '{{name}} must not be between {{min}} and {{max}}',
)]
final class BetweenCustom extends Simple
{
    public function __construct(
        private readonly int $min,
        private readonly int $max
    ) {
    }
    
    protected function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }
        
        return $input >= $this->min && $input <= $this->max;
    }
    
    protected function getParameters(): array
    {
        return [
            'min' => $this->min,
            'max' => $this->max,
        ];
    }
}
```

The `getParameters()` method allows you to pass custom parameters to the template messages.
