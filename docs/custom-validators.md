# Custom validators

You can also create and use your own validators. To do this, you will need to create
a validator and an exception to go with the validator.

To create a validator, you need to create a class that implements the `Validator` interface
and is within the Validators `namespace`. It is convenient to just extend the `Simple` or
`Standard` class. When the validator is called the logic inside the validate method will be
executed. Here's how the class should look:

```php
namespace My\Validation\Validators;

use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

#[Template(
    '{{subject}} is something',
    '{{subject}} is not something',
)]
final class Something extends Simple
{
    protected function isValid(mixed $input): bool
    {
        // Do something here with the $input and return a boolean value
    }
}
```

The `'{{subject}} is not something` message would be used then you call the validator
with the `not()`.

All classes in Validation are created by the `Factory` class. If you want
Validation to execute your validator (or validators) in the chain, you must overwrite the
default `Factory`.

```php
Factory::setDefaultInstance(
    (new Factory())
        ->withNamespace('My\\Validation\\Validators')
);
v::something(); // Try to load "My\Validation\Validators\Something" if any
```
