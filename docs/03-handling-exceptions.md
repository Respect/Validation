# Handling exceptions

The `Validator::assert()` method simplifies exception handling by throwing `ValidationException` exceptions when validation fails. These exceptions provide detailed feedback on what went wrong.
## Full exception message

The `getFullMessage()` method will return a full comprehensive explanation of rules that didn't pass in a nested Markdown list format.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::alnum()->lowercase()->assert('The Respect Panda');
} catch(ValidationException $exception) {
   echo $exception->getFullMessage();
}
```

The code above generates the following output:

```no-highlight
- All the required rules must pass for "The Respect Panda"
  - "The Respect Panda" must contain only letters (a-z) and digits (0-9)
  - "The Respect Panda" must contain only lowercase letters
```

## Getting all messages as an array

Retrieve validation messages in array format using `getMessages()`.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::alnum()->lowercase()->assert('The Respect Panda');
} catch(ValidationException $exception) {
    print_r($exception->getMessages());
}
```

The code above generates the following output:

```no-highlight
Array
(
    [__root__] => All the required rules must pass for "The Respect Panda"
    [alnum] => "The Respect Panda" must contain only letters (a-z) and digits (0-9)
    [lowercase] => "The Respect Panda" must contain only lowercase letters
)
```

When validating with [Key](rules/Key.md) or [Property](rules/Property.md) the keys of will correspond to the name of the key or property that failed the validation.
## Custom templates

You can tailor the messages to better suit your needs.

### Custom templates when asserting

Pass custom templates directly to the `assert()` method for one-off use cases.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::alnum()
	    ->lowercase()
	    ->assert(
		    'The Respect Panda',
			[
			    '__root__' => 'The given input is not valid',
			    'alnum' => 'Your username must contain only letters and digits',
			    'lowercase' => 'Your username must be lowercase',
			]
		);
} catch(ValidationException $exception) {
    print_r($exception->getMessages());
}
```

The code above will generate the following output.

```no-highlight
Array
(
    [__root__] => The given input is not valid
    [alnum] => Your username must contain only letters and digits
    [lowercase] => Your username must be lowercase
)
```

### Custom templates in the validator

Define templates within a validator so you can reuse the same templates easily.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

$validator = v::alnum()->lowercase();
$validator->setTemplates([
    '__root__' => '{{name}} is not valid',
    'alnum' => 'Usernames must contain only letters and digits',
    'lowercase' => 'Usernames must be lowercase',
]);

try {
    $validator->assert('The Respect Panda');
} catch(ValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

echo PHP_EOL;

try {
    $validator->assert('Something else');
} catch(ValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
```

The code above will generate the following output.

```no-highlight
- "The Respect Panda" is not valid
  - Usernames must contain only letters and digits
  - Usernames must be lowercase

- "Something else" is not valid
  - Usernames must contain only letters and digits
  - Usernames must be lowercase
```
