<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown\Linters;

use ReflectionClass;
use Respect\Dev\Markdown\Content;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;
use Respect\Validation\Message\Template;
use UnexpectedValueException;

use function array_find_key;
use function basename;
use function preg_match;
use function preg_replace;
use function sprintf;
use function str_contains;
use function str_starts_with;

final readonly class ValidatorTemplatesLinter implements Linter
{
    public function lint(File $file): File
    {
        if (!str_contains($file->filename, '/validators/')) {
            return $file;
        }

        $validator = basename($file->filename, '.md');
        $templates = $this->getTemplates($validator);

        if ($templates === []) {
            return $file;
        }

        $descriptions = [];
        try {
            $currentTemplates = $file->content->getSection('## Templates');
            $templateLines = $currentTemplates->toArray();
            foreach ($templateLines as $index => $currentLine) {
                if (!str_starts_with($currentLine, '### ')) {
                    continue;
                }

                $id = preg_replace('/^### `.+::([A-Z_]+)`/', '$1', $currentLine);
                if (!isset($templateLines[$index + 2]) || !preg_match('/^[A-Z]/', $templateLines[$index + 2])) {
                    continue;
                }

                $descriptions[$id] = $templateLines[$index + 2];
            }
        } catch (UnexpectedValueException) {
            // No existing Templates section, that's fine
        }

        $content = new Content();
        $content->h2('Templates');
        foreach ($templates as $id => $template) {
            $content->h3(sprintf('`%s::%s`', $validator, $id));
            if (isset($descriptions[$id])) {
                $content->paragraph($descriptions[$id]);
                $content->emptyLine();
            }

            $content->table(['Mode', 'Template'], [
                ['`default`', $template->default],
                ['`inverted`', $template->inverted],
            ]);
        }

        return $file->withContent($file->content->withSection($content));
    }

    /** @return array<string, Template> */
    private function getTemplates(string $validator): array
    {
        $reflectionClass = new ReflectionClass('Respect\\Validation\\Validators\\' . $validator);
        $constants = $reflectionClass->getConstants();

        $templates = [];
        foreach ($reflectionClass->getAttributes(Template::class) as $attribute) {
            $template = $attribute->newInstance();
            $id = array_find_key($constants, static fn($constant) => $template->id === $constant);
            if ($id === null) {
                continue;
            }

            $templates[$id] = $template;
        }

        return $templates;
    }
}
