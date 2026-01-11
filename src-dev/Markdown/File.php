<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown;

use Symfony\Component\Finder\SplFileInfo;

use function file_put_contents;

final readonly class File
{
    public function __construct(
        public string $filename,
        public Content $content,
    ) {
    }

    public static function from(SplFileInfo $file): self
    {
        return new self($file->getRealPath(), Content::from($file->getRealPath()));
    }

    public function withContent(Content $content): self
    {
        if ($content->build() === $this->content->build()) {
            return $this;
        }

        return clone($this, ['content' => $content]);
    }

    public function save(): void
    {
        file_put_contents($this->filename, $this->content->build());
    }
}
