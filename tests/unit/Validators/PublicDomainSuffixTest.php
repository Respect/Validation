<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;
use Respect\Validation\Helpers\DataLoader;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(PublicDomainSuffix::class)]
final class PublicDomainSuffixTest extends RuleTestCase
{
    protected function setUp(): void
    {
        $this->setDataLoaderCache([]);
    }

    /** @return iterable<array{PublicDomainSuffix, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PublicDomainSuffix();

        return [
            [$validator, ''],
            [$validator, 'co.uk'],
            [$validator, 'CO.UK'],
            [$validator, 'co.ck'],
            [$validator, 'com.br'],
            [$validator, 'blogspot.com'],
            [$validator, 'ทหาร.ไทย'],
            [$validator, '個人.香港'],
        ];
    }

    /** @return iterable<array{PublicDomainSuffix, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PublicDomainSuffix();

        return [
            [$validator, []],
            [$validator, null],
            [$validator, new stdClass()],
            [$validator, 'NONONONONONONONONON'],
            [$validator, 'NONONONONONONONONON.uk'],
            [$validator, 'invalid.com'],
            [$validator, 'www.ck'],
            [$validator, 'nom.br'],
            [$validator, 'tk'],
        ];
    }

    #[Test]
    public function shouldRejectInputWithEmptyTld(): void
    {
        self::assertInvalidInput(new PublicDomainSuffix(), 'co.');
    }

    #[Test]
    public function shouldFallbackToUnicodeWhenAsciiNormalizationFails(): void
    {
        $this->setDataLoaderCache([
            'domain/public-suffix/ZZTEST.php' => [
                'rules' => [],
                'wildcards' => [],
                'exceptions' => [],
            ],
        ]);

        self::assertInvalidInput(new PublicDomainSuffix(), 'a..zztest');
    }

    #[Test]
    public function shouldValidateUsingUnicodeRuleOnSecondPass(): void
    {
        $this->setDataLoaderCache([
            'domain/public-suffix/XN--J6W193G.php' => [
                'rules' => ['個人.香港'],
                'wildcards' => [],
                'exceptions' => [],
            ],
        ]);

        self::assertValidInput(new PublicDomainSuffix(), '個人.香港');
    }

    #[Test]
    public function shouldValidateParentOfExceptionAndIgnoreMalformedExceptionRule(): void
    {
        $this->setDataLoaderCache([
            'domain/public-suffix/ZZTEST.php' => [
                'rules' => [],
                'wildcards' => ['CITY.ZZTEST'],
                'exceptions' => ['MALFORMED', 'A.CITY.ZZTEST'],
            ],
        ]);

        self::assertValidInput(new PublicDomainSuffix(), 'city.zztest');
    }

    /** @param array<string, array{rules: list<string>, wildcards: list<string>, exceptions: list<string>}> $cache */
    private function setDataLoaderCache(array $cache): void
    {
        $reflection = new ReflectionClass(DataLoader::class);
        $property = $reflection->getProperty('runtimeCache');
        $property->setValue(null, $cache);
    }
}
