<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx\ContributorExtractor;

use Respect\Dev\Spdx\Contributor;

use function array_values;
use function preg_match;
use function uasort;

final readonly class NormalizingContributorExtractor implements ContributorExtractor
{
    private const array EXCLUDED_PATTERNS = [
        '/dependabot\[bot\]/',
        '/github-actions\[bot\]/',
        '/therespectpanda/',
    ];

    public function __construct(
        private ContributorExtractor $extractor,
    ) {
    }

    /** @return array<Contributor> */
    public function extract(string $filepath): array
    {
        $contributors = $this->extractor->extract($filepath);
        $normalized = [];

        foreach ($contributors as $contributor) {
            if ($contributor->name === 'Not Committed Yet') {
                continue;
            }

            if ($contributor->email !== null && $this->isExcluded($contributor->email)) {
                continue;
            }

            if ($this->isExcluded($contributor->name)) {
                continue;
            }

            $normalized[$contributor->name] = $contributor;
        }

        uasort($normalized, static fn($a, $b) => $a <=> $b);

        return array_values($normalized);
    }

    private function isExcluded(string $value): bool
    {
        foreach (self::EXCLUDED_PATTERNS as $pattern) {
            if (preg_match($pattern, $value) === 1) {
                return true;
            }
        }

        return false;
    }
}
