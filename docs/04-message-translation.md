# Message translation

You're able to translate message templates with Validation.

```php
use Respect\Validation\Message\Translator\GettextTranslator;
use Respect\Validation\ValidatorDefaults;

ValidatorDefaults::setTranslator(new GettextTranslator());
```

After that, if you call the methods `getMessage()`, `getMessages()`, or `getFullMessage()` from the `ValidationException`, the messages will be translated. The example above will work if you have `gettext` properly configured.

For non-static usage, pass the translator directly to the `Validator` constructor:

```php
use Respect\Validation\Factory;
use Respect\Validation\Message\StandardFormatter;
use Respect\Validation\Message\Translator\GettextTranslator;
use Respect\Validation\Validator;

$translator = new GettextTranslator();

$validator = new Validator(new Factory(), new StandardFormatter(), $translator);
```

## Message customization with Named and Templated rules

Version 3.0 introduces `Named` and `Templated` rules for clearer message customization:

```php
use Respect\Validation\Validator as v;

// Using Named rule for better identification
$usernameValidator = v::named(v::alnum()->lowercase(), 'Username');

// Using Templated rule for custom message
$customMessageValidator = v::templated(
    v::named(v::alnum()->lowercase(), 'Username'),
    '{{name}} must be a valid username'
);

// Using assert() overload for custom messages
$emailValidator = v::email()->assert($input, 'Please provide a valid email address');
```

## Placeholder Behaviors and Formatting Changes

Version 3.0 introduces enhanced placeholder conversion with locale-aware formatting:

```php
use Respect\Validation\Validator as v;

// Placeholders are now formatted with locale awareness
$validator = v::between(1000, 2000);

try {
    $validator->assert(500);
} catch (ValidationException $exception) {
    // In v3.0, numeric values are formatted with locale-aware
    // For en_US: "500 must be between 1,000 and 2,000"
    // For de_DE: "500 must be between 1.000 and 2.000"
    echo $exception->getMessage();
}
```

## New Placeholder Filters

Version 3.0 introduces placeholder filters for more flexible message formatting:

```php
use Respect\Validation\Validator as v;

// Using the quote filter to properly format values in messages
$validator = v::templated(
    v::equals('hello world'),
    'Expected {{expected|quote}}, got {{input|quote}}'
);

try {
    $validator->assert('goodbye');
} catch (ValidationException $exception) {
    // Output: Expected "hello world", got "goodbye"
    echo $exception->getMessage();
}
```

Available filters include:
- `quote` - Adds quotes around string values
- `lowercase` - Converts to lowercase
- `uppercase` - Converts to uppercase
- `ucfirst` - Capitalizes first letter
- `ucwords` - Capitalizes first letter of each word

## Supported translators

- `ArrayTranslator`: Translates messages using an array of messages.
- `GettextTranslator`: Translates messages using the `gettext` extension.

## Custom translators

You can implement custom translators by creating a class that implements the `Translator` interface. Here's an example using the `stichoza/google-translate-php` package:

```php
use Respect\Validation\Message\Translator;
use Stichoza\GoogleTranslate\GoogleTranslate;

final class MyTranslator implements Translator
{
    public function __construct(
        private readonly GoogleTranslate $googleTranslate
    ) {
    }

    public function translate(string $message): string
    {
        return $this->googleTranslate->translate($message);
    }
}
```
