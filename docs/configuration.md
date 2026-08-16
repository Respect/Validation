<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
-->

# Configuration

## Container configuration

The `ContainerRegistry::createContainer()` method returns a [Respect\Config](https://github.com/Respect/Config) container, which is [PSR-11](https://www.php-fig.org/psr/psr-11/) compatible. Definitions may be plain values, closures, or Respect\Config's `Autowire`, `Instantiator`, and `Ref` helpers.

If you prefer to use a different container, `ContainerRegistry::setContainer()` accepts any PSR-11 compatible container:

```php
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer($yourPsr11Container);
```

## Clock

Validators that need to know what time it is take a [PSR-20](https://www.php-fig.org/psr/psr-20/) clock. The
`respect.validation.clock` definition names the class to use, and by default that is a system clock, which reads the
current time every time it is asked, just as PHP does on its own:

```php
'respect.validation.clock' => SystemClock::class,
```

Naming `FrozenClock` instead gives each validation chain a clock of its own, held still at the moment the validation
starts and taken again on every run, so that every validator of a chain agrees on what "now" is:

```php
use Lcobucci\Clock\FrozenClock;
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer(
    ContainerRegistry::createContainer([
        'respect.validation.clock' => FrozenClock::class,
    ])
);
```

A chain takes its clock when it is built, so configure the container before building any validator. To validate
against a moment of your choosing, give the clock to the validator itself:

```php
v::with(new DateTimeDiff('years', v::greaterThan(18), null, null, new FrozenClock($moment)))->assert($birthDate);
```
