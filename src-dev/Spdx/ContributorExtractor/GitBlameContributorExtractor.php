<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx\ContributorExtractor;

use Respect\Dev\Spdx\Contributor;
use Symfony\Component\Process\Process;

use function preg_match_all;

final class GitBlameContributorExtractor implements ContributorExtractor
{
    /** @return array<Contributor> */
    public function extract(string $filepath): array
    {
        $process = new Process(['git', 'blame', '--porcelain', $filepath]);
        $process->run();

        if (!$process->isSuccessful()) {
            return [];
        }

        $output = $process->getOutput();
        $contributors = [];

        preg_match_all('/^author (.+)$/m', $output, $authorMatches);
        preg_match_all('/^author-mail <(.+)>$/m', $output, $emailMatches);

        foreach ($authorMatches[1] as $index => $name) {
            $email = $emailMatches[1][$index] ?? '';
            if ($email === '' || $name === 'Not Committed Yet') {
                continue;
            }

            $contributors[] = Contributor::create($name, $email);
        }

        return $contributors;
    }
}
