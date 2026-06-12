<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Configuration

## Container configuration

The `ContainerRegistry::createContainer()` method returns a [PHP-DI](https://php-di.org/) container. The definitions array follows the [PHP-DI definitions format](https://php-di.org/doc/php-definitions.html).

If you prefer to use a different container, `ContainerRegistry::setContainer()` accepts any [PSR-11](https://www.php-fig.org/psr/psr-11/) compatible container:

```php
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer($yourPsr11Container);
```

## Service injection

When a validator is created — through the fluent API or through PHP attributes — the constructor parameters that are not filled by the given arguments are resolved from the container, as long as the parameter type is a class or interface the container can provide.

Some bundled validators rely on services that you might want to customize:

| Validator                                        | Service                                                                     |
| :----------------------------------------------- | :-------------------------------------------------------------------------- |
| [CountryCode](validators/CountryCode.md)         | `Sokil\IsoCodes\Database\Countries`                                         |
| [CurrencyCode](validators/CurrencyCode.md)       | `Sokil\IsoCodes\Database\Currencies`                                        |
| [Email](validators/Email.md)                     | `Egulias\EmailValidator\EmailValidator`                                     |
| [LanguageCode](validators/LanguageCode.md)       | `Sokil\IsoCodes\Database\Languages`                                         |
| [Phone](validators/Phone.md)                     | `libphonenumber\PhoneNumberUtil`, `Sokil\IsoCodes\Database\Countries`       |
| [SubdivisionCode](validators/SubdivisionCode.md) | `Sokil\IsoCodes\Database\Countries`, `Sokil\IsoCodes\Database\Subdivisions` |
| [Uuid](validators/Uuid.md)                       | `Ramsey\Uuid\UuidFactory`                                                   |

You do not need to define any of those services yourself: when the container does not provide a service, validators fall back to a sensible default. Define a service only when you want to customize it:

```php
use Respect\Validation\ContainerRegistry;
use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\TranslationDriver\SymfonyTranslationDriver;

ContainerRegistry::setContainer(ContainerRegistry::createContainer([
    Countries::class => new Countries(null, new SymfonyTranslationDriver()),
]));

v::countryCode()->assert('BR');
```

Note that a few kinds of constructor parameters are never injected:

- Parameters already filled by the given arguments.
- Variadic and union-typed parameters.
- Parameters whose type is in the unresolvable types list, which are value-like or rule-like and must come from the arguments or from the parameter default. By default, the list includes `DateTimeImmutable`, `DateTime`, `DateTimeInterface`, and `Validator`.

You can customize the unresolvable types by overriding the `ArgumentsResolver` service in the container — see [Custom arguments resolver](#custom-arguments-resolver) below.

## Custom arguments resolver

The injection behavior is defined by the `Respect\Validation\ArgumentsResolver` interface, whose default implementation is `Respect\Validation\ContainerArgumentsResolver`. If you want a different resolution strategy — creating services directly instead of going through a container, for example — define your own implementation in the container:

```php
use Respect\Validation\ArgumentsResolver;
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer(ContainerRegistry::createContainer([
    ArgumentsResolver::class => new MyArgumentsResolver(),
]));
```

Both the validator factory and the [Attributes](validators/Attributes.md) validator use the resolver, so a custom implementation affects rules created through the fluent API and through PHP attributes alike.
