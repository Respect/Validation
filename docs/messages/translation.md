<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Message translation

Validation provides full translation capabilities, but they are not enabled by default nor
do we provide official translations for our messages other than English.

Therefore, if you want to use it with translation, you must provide the translations yourself
using a compatible [translation contract](https://github.com/symfony/translation-contracts).

Here's a quick setup using [symfony/translation](https://symfony.com/doc/current/translation.html):

```php
use Respect\Validation\ContainerRegistry;
use Respect\Validation\Message\TemplateRegistry;
use Respect\Validation\Validators as vs;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;

$templates = new TemplateRegistry();
$translator = new Translator('pt_BR');
$translator->addLoader('array', new ArrayLoader()); // Choose the loader of your preference
$translator->addResource('array', [
    // Reference standard template by class (StringVal, Intval, ...) and mode (default or inverted)
    $templates->get(vs\IntVal::class)->default => '{{subject}} DEVE ser um inteiro.',
    $templates->get(vs\IntVal::class)->inverted => '{{subject}} NÃO DEVE ser um inteiro.',

    // Reference alternative templates by their id (second argument)
    $templates->get(vs\AllOf::class, vs\AllOf::TEMPLATE_ALL)->default => 'Todas as regras requeridas DEVEM passar para {{subject}}',

    // You can also just translate messages directly
    '{{subject}} must be a URL' => '{{subject}} DEVE ser uma URL'
]);

$container = ContainerRegistry::createContainer([
    TranslatorInterface::class => $translator,
    TemplateRegistry::class => $templates
]);
ContainerRegistry::setContainer($container);
```

You only need to do this once before you perform any validation, and messages will start
being produced with your translation setup. If you're using a framework, you can configure
this in the service provider of your choice.

Check out the documentation for each validator for its available modes and existing messages
and the [configuration](../configuration.md) section.

## Translating dynamic values

Validation messages contain placeholders like `{{subject}}` and `{{minValue}}` that are replaced with actual values. Some of these values may also need translation.

You will encounter several messages with `|trans` in different validators. Those enable the 
translation of such dynamic values automatically.

```php
// Message template
'{{subject}} must be a valid phone number for country {{countryName|trans}}'

// Translations needed
'{{subject}} must be a valid phone number for country {{countryName|trans}}' => '{{subject}} deve ser um número de telefone válido para o país {{countryName|trans}}',
'Palestine' => 'Palestina',
```

The `|trans` modifier will also work with custom templates defined by [Templated](../validators/Templated.md) or provided by [`assert`](../handling-exceptions.md).

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
