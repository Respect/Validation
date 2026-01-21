<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class TestingTranslator implements TranslatorInterface
{
    /** @param array<string, string> $translations */
    public function __construct(
        private array $translations = [],
    ) {
    }

    /** @param array<string, mixed> $parameters */
    public function trans(
        string $id,
        array $parameters = [],
        string|null $domain = null,
        string|null $locale = null,
    ): string {
        return $this->translations[$id] ?? $id;
    }

    public function getLocale(): string
    {
        return 'en';
    }
}
