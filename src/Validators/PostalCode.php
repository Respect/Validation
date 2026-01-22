<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Axel Wargnier <axel@axessweb.fr>
 * SPDX-FileContributor: Bogus <g.predl@edis.at>
 * SPDX-FileContributor: Brian Johnson
 * SPDX-FileContributor: Daniel Alt <julien.altenburg@gmail.com>
 * SPDX-FileContributor: Daniel Altenburg
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Markus.Lauer <markus@kfm-motorraeder.de>
 * SPDX-FileContributor: Mateusz Burzyński <matburzy@gmail.com>
 * SPDX-FileContributor: Michał Prochowski <Michal.Prochowski@komputronik.pl>
 * SPDX-FileContributor: ong-ar <reclusis@gmail.com>
 * SPDX-FileContributor: Sebastian <me@sebastianpontow.de>
 * SPDX-FileContributor: Tomasz Regdos <tomek@regdos.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Envelope;

use function dirname;

/** @see http://download.geonames.org/export/dump/countryInfo.txt */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid postal code on {{countryCode}}',
    '{{subject}} must not be a valid postal code on {{countryCode}}',
)]
final class PostalCode extends Envelope
{
    private const array POSTAL_CODES_EXTRA = [
        // phpcs:disable Generic.Files.LineLength.TooLong
        'AM' => ['/^\d{4}$/', '/^(\d{4})$/'],
        'BR' => ['/^\d{5}-\d{3}$/', '/^\d{5}-?\d{3}$/'],
        'EC' => ['/^\d{6}$/', '/^(\d{6})$/'],
        'GR' => ['/^\d{3} \d{2}$/', '/^(\d{3}\s?\d{2})$/'],
        'GB' => ['/^\w\d \d\w{2}|\w\d{2} \d\w{2}|\w{2}\d \d\w{2}|\w{2}\d{2} \d\w{2}|\w\d\w \d\w{2}|\w{2}\d\w \d\w{2}|GIR 0AA$/', '/^([Gg][Ii][Rr]\s?0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))\s?[0-9][A-Za-z]{2})$/'],
        'KH' => ['/^\d{6}?$/', '/^(\d{5,6})$/'],
        'KY' => ['/^KY[1-3]-\d{4}$/', '/^KY[1-3]-?\d{4}$/'],
        'PT' => ['/^\d{4}-\d{3}$/', '/^\d{4}-?\d{3}\s?[a-zA-Z]{0,25}$/'],
        'RS' => ['/^\d{6}?$/', '/^(\d{5,6})$/'],
        // phpcs:enable Generic.Files.LineLength.TooLong
    ];

    public function __construct(string $countryCode, bool $formatted = false)
    {
        $countryCodeRule = new CountryCode();
        if (!$countryCodeRule->evaluate($countryCode)->hasPassed) {
            throw new InvalidValidatorException('Cannot validate postal code from "%s" country', $countryCode);
        }

        parent::__construct(
            new Regex($this->buildRegex($countryCode, $formatted)),
            ['countryCode' => $countryCode],
        );
    }

    /** @return array<string, array{string, string}> */
    private function getPostalCodes(): array
    {
        static $postalCodes = null;

        return $postalCodes ??= require dirname(__DIR__, 2) . '/data/postal-code.php';
    }

    private function buildRegex(string $countryCode, bool $formatted): string
    {
        $index = $formatted ? 0 : 1;
        $postalCodes = $this->getPostalCodes();

        return self::POSTAL_CODES_EXTRA[$countryCode][$index] ?? $postalCodes[$countryCode][$index] ?? '/^$/';
    }
}
