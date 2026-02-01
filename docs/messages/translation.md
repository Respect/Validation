<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Message translation

Validation uses [symfony/translation](https://symfony.com/doc/current/translation.html) for message translation, providing interoperability with the Symfony ecosystem and other PHP projects.

By default, validation messages are not translated. To enable translation, provide a `Symfony\Contracts\Translation\TranslatorInterface` implementation to `ContainerRegistry::createContainer()`:

```php
use Respect\Validation\ContainerRegistry;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;

// Create your Symfony Translator instance
// See: https://symfony.com/doc/current/translation.html
$translator = new Translator('pt_BR');
// ... configure loaders and resources

$container = ContainerRegistry::createContainer([
    TranslatorInterface::class => $translator,
]);

ContainerRegistry::setContainer($container);
```

After setting up the container, all messages produced by Validation will your translator.

## Translating dynamic values

Validation messages contain placeholders like `{{subject}}` and `{{minValue}}` that are replaced with actual values. Some of these values may also need translation.

Use the `|trans` modifier to translate parameter values:

```php
// Message template
'{{subject}} must be a valid telephone number for country {{countryName|trans}}'

// Translations needed
'{{subject}} must be a valid telephone number for country {{countryName|trans}}' => '{{subject}} deve ser um número de telefone válido para o país {{countryName|trans}}',
'Palestine' => 'Palestina',
```

## Translating lists

When using validators that display lists of values, use the `|list:or` or `|list:and` modifiers. These modifiers also require translating the conjunctions:

```php
// Message template with "or" conjunction
'Your name must be {{haystack|list:or}}'

// Translations needed
'Your name must be {{haystack|list:or}}' => 'Seu nome deve ser {{haystack|list:or}}',
'or' => 'ou',

// Message template with "and" conjunction
'{{haystack|list:and}} are the only possible names'

// Translations needed
'{{haystack|list:and}} are the only possible names' => '{{haystack|list:and}} são os únicos nomes possíveis',
'and' => 'e',
```

## Container configuration

The `ContainerRegistry::createContainer()` returns a PSR-11 compatible container.

If you prefer to use a different container, `ContainerRegistry::setContainer()` accepts any [PSR-11](https://www.php-fig.org/psr/psr-11/) compatible container:

```php
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer($yourPsr11Container);
```
