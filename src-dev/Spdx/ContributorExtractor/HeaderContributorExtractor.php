<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx\ContributorExtractor;

use Respect\Dev\Spdx\Contributor;

use function file_get_contents;
use function preg_match;
use function preg_match_all;

final readonly class HeaderContributorExtractor implements ContributorExtractor
{
    public function __construct(
        private string $extensionPattern,
    ) {
    }

    /** @return array<Contributor> */
    public function extract(string $filepath): array
    {
        $content = file_get_contents($filepath);
        preg_match($this->extensionPattern, $content, $matches);
        $header = $matches[1] ?? '';

        preg_match_all('/SPDX-FileContributor:\s*(.+)$/m', $header, $matches);

        $contributors = [];
        if (isset($matches[1]) === false) {
            return $contributors;
        }

        foreach ($matches[1] as $contributor) {
            preg_match('/^(.+)( <(.+)>)?$/', $contributor, $parts);
            $name = $parts[1] ?? '';
            $email = $parts[3] ?? null;
            if ($name === '') {
                continue;
            }

            $contributors[] = Contributor::create($name, $email);
        }

        return $contributors;
    }
}
