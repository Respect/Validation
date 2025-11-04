# Handling exceptions

The `Validator::assert()` method simplifies exception handling by throwing `ValidationException` exceptions when validation fails. These exceptions provide detailed feedback on what went wrong.

## Exception Types and Hierarchy

Version 3.0 maintains a clear exception hierarchy for better error handling:

- `Respect\Validation\Exceptions\ValidationException` - Base exception for all validation errors
  - `Respect\Validation\Exceptions\ResultException` - Thrown by Validator::assert() with detailed result information
  - `Respect\Validation\Exceptions\RuleException` - Base for rule-specific exceptions
    - `Respect\Validation\Exceptions\SimpleException` - For simple validation failures
    - `Respect\Validation\Exceptions\CompositeException` - For composite rule failures (AllOf, AnyOf, OneOf, etc.)

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
- "The Respect Panda" must pass all the rules
  - "The Respect Panda" must contain only letters (a-z) and digits (0-9)
  - "The Respect Panda" must contain only lowercase letters
```

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

### Custom messages with Named and Templated rules

Version 3.0 introduces `Named` and `Templated` rules for clearer message customization:

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

// Using Named rule for better identification
$validator = v::named(v::alnum()->lowercase(), 'Username');

try {
    $validator->assert('The Respect Panda');
} catch(ValidationException $exception) {
    echo $exception->getFullMessage();
    // Output: - "The Respect Panda" must be a valid Username
    //         - "The Respect Panda" must contain only letters (a-z) and digits (0-9)
    //         - "The Respect Panda" must contain only lowercase letters
}

// Using Templated rule for custom message
$validator = v::templated(
    v::named(v::alnum()->lowercase(), 'Username'),
    '{{name}} must be a valid username'
);

try {
    $validator->assert('The Respect Panda');
} catch(ValidationException $exception) {
    echo $exception->getFullMessage();
    // Output: - "The Respect Panda" must be a valid username
    //         - "The Respect Panda" must contain only letters (a-z) and digits (0-9)
    //         - "The Respect Panda" must contain only lowercase letters
}
```

### Custom exception objects

Integrate your own exception objects when the validation fails:

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::email()->assert('invalid', new DomainException('Please provide a valid email address'));
} catch(DomainException $exception) {
    echo $exception->getMessage(); // "Please provide a valid email address"
} catch(ValidationException $exception) {
    echo $exception->getMessage(); // Default message
}
```

### Custom exception objects via callable

Provide a callable that handles the exception when the validation fails:

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::email()->assert(
        'invalid',
        fn(ValidationException $exception) => new DomainException('Email: ' . $exception->getMessage())
    );
} catch(DomainException $exception) {
    echo $exception->getMessage(); // "Email: \"invalid\" must be a valid email address"
}
```

The code above generates the following output:

```no-highlight
- "The Respect Panda" must pass all the rules
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
    [__root__] => "The Respect Panda" must pass all the rules
    [alnum] => "The Respect Panda" must contain only letters (a-z) and digits (0-9)
    [lowercase] => "The Respect Panda" must contain only lowercase letters
)
```

When validating with [Key](rules/Key.md) or [Property](rules/Property.md) the keys will correspond to the name of the key or property that failed the validation.

## Enhanced Error Handling with Paths

Version 3.0 introduces structured result trees with path-based error identification for nested structures.

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

$validator = v::keySet(
    v::key('user', v::keySet(
        v::key('email', v::email())
    ))
);

try {
    $validator->assert(['user' => ['email' => 'invalid']]);
} catch(ValidationException $exception) {
    // v3.0: Paths identify nested failures
    // "user.email must be a valid email"
    echo $exception->getMessage(); // More specific error message
    
    // Get specific error by path
    // $emailError = $exception->getMessage('user.email');
    
    // Get full result tree (if available)
    // $result = $exception->getResult(); // Only available on ResultException
}
```

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

### Custom messages with Named and Templated rules

Version 3.0 introduces `Named` and `Templated` rules for clearer message customization:

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

// Using Named rule for better identification
$validator = v::named(v::alnum()->lowercase(), 'Username');

try {
    $validator->assert('The Respect Panda');
} catch(ValidationException $exception) {
    echo $exception->getFullMessage();
    // Output: - "The Respect Panda" must be a valid Username
    //         - "The Respect Panda" must contain only letters (a-z) and digits (0-9)
    //         - "The Respect Panda" must contain only lowercase letters
}

// Using Templated rule for custom message
$validator = v::templated(
    v::named(v::alnum()->lowercase(), 'Username'),
    '{{name}} must be a valid username'
);

try {
    $validator->assert('The Respect Panda');
} catch(ValidationException $exception) {
    echo $exception->getFullMessage();
    // Output: - "The Respect Panda" must be a valid username
    //         - "The Respect Panda" must contain only letters (a-z) and digits (0-9)
    //         - "The Respect Panda" must contain only lowercase letters
}
```

### Custom exception objects

Integrate your own exception objects when the validation fails:

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::email()->assert('invalid', new DomainException('Please provide a valid email address'));
} catch(DomainException $exception) {
    echo $exception->getMessage(); // "Please provide a valid email address"
} catch(ValidationException $exception) {
    echo $exception->getMessage(); // Default message
}
```

### Custom exception objects via callable

Provide a callable that handles the exception when the validation fails:

```php
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::email()->assert(
        'invalid',
        fn(ValidationException $exception) => new DomainException('Email: ' . $exception->getMessage())
    );
} catch(DomainException $exception) {
    echo $exception->getMessage(); // "Email: \"invalid\" must be a valid email address"
}
```

The code above generates the following output:

```no-highlight
Array
(
    [__root__] => "The Respect Panda" must pass all the rules
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
