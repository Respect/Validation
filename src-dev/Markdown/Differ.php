<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown;

use SebastianBergmann\Diff\Differ as SebastianBergmannDiffer;

use function getcwd;
use function preg_replace_callback;
use function sprintf;
use function str_replace;

use const PHP_EOL;

final readonly class Differ
{
    public function __construct(
        private SebastianBergmannDiffer $differ,
    ) {
    }

    public function diff(File $from, File $to): string|null
    {
        $diff = $this->differ->diff($from->content->build(), $to->content->build());
        if ($diff === '') {
            return null;
        }

        $content = sprintf('<options=bold>--- a/%s</>' . PHP_EOL, $this->getRelativePath($from->filename));
        $content .= sprintf('<options=bold>+++ b/%s</>' . PHP_EOL, $this->getRelativePath($to->filename));

        return $content . preg_replace_callback(
            '/^([+-]|@{2})(.*)$/m',
            static fn($matches) => sprintf(
                '<fg=%s>%s</>',
                match ($matches[1]) {
                    '+' => 'green',
                    '-' => 'red',
                    '@@' => 'cyan',
                },
                $matches[0],
            ),
            $diff,
        );
    }

    private function getRelativePath(string $filename): string
    {
        return str_replace(getcwd() . '/', '', $filename);
    }
}
