# Custom rules

You can also create and use your own rules. To do this, you will need to create
a rule and an exception to go with the rule.

To create a rule, you need to create a class that extends the AbstractRule class
and is within the Rules `namespace`. When the rule is called the logic inside the
validate method will be executed. Here's how the class should look:

```php
namespace My\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

final class Something extends AbstractRule
{
    public function validate($input): bool
    {
        // Do something here with the $input and return a boolean value
    }
}
```

Each rule must have an Exception to go with it. Exceptions should be named
with the name of the rule followed by the word Exception. The process of creating
an Exception is similar to creating a rule but there are no methods in the
Exception class. Instead, you create one static property that includes an
array with the information below:

```php
namespace My\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class SomethingException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Validation message if Something fails validation.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Validation message if the negative of Something is called and fails validation.',
        ],
    ];
}
```

So in the end, the folder structure for your Rules and Exceptions should look
something like the structure below. Note that the folders (and namespaces) are
plural but the actual Rules and Exceptions are singular.

```
My
 +-- Validation
     +-- Exceptions
         +-- SomethingException.php
     +-- Rules
         +-- Something.php
```

All classes in Validation are created by the `Factory` class. If you want
Validation to execute your rule (or rules) in the chain, you must overwrite the
default `Factory`.

```php
Factory::setDefaultInstance(
    (new Factory())
        ->withRuleNamespace('My\\Validation\\Rules')
        ->withExceptionNamespace('My\\Validation\\Exceptions')
);
v::something(); // Try to load "My\Validation\Rules\Something" if any
```
