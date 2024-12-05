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
