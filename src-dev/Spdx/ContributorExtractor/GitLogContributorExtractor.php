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

use function explode;
use function preg_match;
use function trim;

final class GitLogContributorExtractor implements ContributorExtractor
{
    /** @return array<Contributor> */
    public function extract(string $filepath): array
    {
        $process = new Process(['git', 'log', '--follow', '--format=%aN <%aE>', $filepath]);
        $process->run();

        if (!$process->isSuccessful()) {
            return [];
        }

        $contributors = [];

        foreach (explode("\n", trim($process->getOutput())) as $line) {
            if ($line === '') {
                continue;
            }

            preg_match('/^(.+) <(.+)>$/', $line, $matches);
            $name = $matches[1] ?? '';
            $email = $matches[2] ?? '';

            if ($email === '' || $name === 'Not Committed Yet') {
                continue;
            }

            $contributors[] = Contributor::create($name, $email);
        }

        return $contributors;
    }
}
