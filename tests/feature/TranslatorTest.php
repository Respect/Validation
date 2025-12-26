<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\ContainerRegistry;
use Respect\Validation\Message\Translator;
use Respect\Validation\Message\Translator\ArrayTranslator;

$container = ContainerRegistry::createContainer();
$container->set(Translator::class, new ArrayTranslator([
    '{{subject}} must pass all the rules' => 'Todas as regras requeridas devem passar para {{subject}}',
    'The length of' => 'O comprimento de',
    '{{subject}} must be a string' => '{{subject}} deve ser uma string',
    '{{subject}} must be between {{minValue}} and {{maxValue}}' => '{{subject}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
    '{{subject}} must be a valid telephone number for country {{countryName|trans}}' => '{{subject}} deve ser um número de telefone válido para o país {{countryName|trans}}',
    'United States' => 'Estados Unidos',
    'years' => 'anos',
    'The number of {{type|trans}} between now and' => 'O número de {{type|trans}} entre agora e',
    '{{subject}} must be equal to {{compareTo}}' => '{{subject}} deve ser igual a {{compareTo}}',
    'Your name must be {{haystack|listOr}}' => 'Seu nome deve ser {{haystack|listOr}}',
    'or' => 'ou',
    '{{haystack|listAnd}} are the only possible names' => '{{haystack|listAnd}} são os únicos nomes possíveis',
    'and' => 'e',
]));

beforeAll(fn() => ContainerRegistry::setContainer($container));

afterAll(fn() => ContainerRegistry::setContainer(ContainerRegistry::createContainer()));

test('Various translations', catchFullMessage(
    fn() => v::stringType()->lengthBetween(2, 15)->phone('US')->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Todas as regras requeridas devem passar para `[]`
          - `[]` deve ser uma string
          - O comprimento de `[]` deve possuir de 2 a 15 caracteres
          - `[]` deve ser um número de telefone válido para o país Estados Unidos
        FULL_MESSAGE),
));

test('DateTimeDiff', catchMessage(
    fn() => v::dateTimeDiff('years', v::equals(2))->assert('1972-02-09'),
    fn(string $message) => expect($message)->toBe('O número de anos entre agora e "1972-02-09" deve ser igual a 2'),
));

test('Using "listOr"', catchMessage(
    fn() => v::templated(v::in(['Respect', 'Validation']), 'Your name must be {{haystack|listOr}}')->assert(''),
    fn(string $message) => expect($message)->toBe('Seu nome deve ser "Respect" ou "Validation"'),
));

test('Using "listAnd"', catchMessage(
    fn() => v::templated(v::in(['Respect', 'Validation']), '{{haystack|listAnd}} are the only possible names')->assert(''),
    fn(string $message) => expect($message)->toBe('"Respect" e "Validation" são os únicos nomes possíveis'),
));
