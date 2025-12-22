# Message translation

We use dependency injection container to create Validators with all their dependencies. One of these dependencies is the `Translator`, which is responsible for translating validation messages.

You can use different translators to translate validation messages into different languages, by overwriting the default container in `ContainerRegistry`, passing the translator you desire.

Luckily, the `ContainerRegistry` has method that creates a pre-configured container using [php-di/php-di](https://php-di.org/). That means you just need to overwrite that service. 

```php
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Message\Translator;
use Respect\Validation\Message\Translator\GettextTranslator;

$container = ContainerRegistry::createContainer(); // returns `DI\Container`
$container->set(Translator::class, new GettextTranslator());

ContainerRegistry::setContainer($container);
```

After that, if you call the methods `getMessage()`, `getMessages()`, or `getFullMessage()` from the `ValidationException`, the messages will be translated. The example above will work if you have `gettext` properly configured.

The `ContainerRegistry` follows the [PSR-11](https://www.php-fig.org/psr/psr-11/) standard, so you can use any container that implements this standard.

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
