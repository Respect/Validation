<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Message\Translator\ArrayTranslator;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorDefaults;

test('Scenario #1', expectFullMessage(
    function (): void {
        ValidatorDefaults::setTranslator(new ArrayTranslator([
            'All the required rules must pass for {{name}}' => 'Todas as regras requeridas devem passar para {{name}}',
            'The length of' => 'O comprimento de',
            '{{name}} must be a string' => '{{name}} deve ser uma string',
            '{{name}} must be between {{minValue}} and {{maxValue}}' => '{{name}} deve possuir de {{minValue}} a {{maxValue}} caracteres',
            '{{name}} must be a valid telephone number for country {{countryName|trans}}'
            => '{{name}} deve ser um número de telefone válido para o país {{countryName|trans}}',
            'United States' => 'Estados Unidos',
        ]));

        Validator::stringType()->lengthBetween(2, 15)->phone('US')->assert([]);
    },
    <<<'FULL_MESSAGE'
    - Todas as regras requeridas devem passar para `[]`
      - `[]` deve ser uma string
      - O comprimento de `[]` deve possuir de 2 a 15 caracteres
      - `[]` deve ser um número de telefone válido para o país Estados Unidos
    FULL_MESSAGE,
));

test('Scenario #2', expectMessage(
    function (): void {
        ValidatorDefaults::setTranslator(new ArrayTranslator([
            'years' => 'anos',
            'The number of {{type|trans}} between now and' => 'O número de {{type|trans}} entre agora e',
            '{{name}} must be equal to {{compareTo}}' => '{{name}} deve ser igual a {{compareTo}}',
        ]));

        v::dateTimeDiff('years', v::equals(2))->assert('1972-02-09');
    },
    'O número de anos entre agora e "1972-02-09" deve ser igual a 2',
));
