<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;
use Respect\Validation\Attributes\Template;
use Respect\Validation\Message\Formatter;

use function count;

class ValidationException extends InvalidArgumentException implements Exception
{
    public const MODE_DEFAULT = 'default';
    public const MODE_NEGATIVE = 'negative';

    private string $mode = self::MODE_DEFAULT;

    /**
     * @var array<Template>
     */
    private readonly array $templates;

    /**
     * @param array<string, mixed> $params
     * @param array<Template> $templates
     */
    public function __construct(
        private readonly mixed $input,
        private readonly string $id,
        private array $params,
        private string $template,
        array $templates,
        private readonly Formatter $formatter
    ) {
        if (count($templates) === 0) {
            $templates = [new Template('{{name}} must be valid', '{{name}} must not be valid')];
        }
        $this->templates = $templates;

        parent::__construct($this->createMessage());
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $name): mixed
    {
        return $this->params[$name] ?? null;
    }

    public function updateMode(string $mode): void
    {
        $this->mode = $mode;
        $this->message = $this->createMessage();
    }

    public function updateTemplate(string $template): void
    {
        $this->template = $template;
        $this->message = $this->createMessage();
    }

    /**
     * @param mixed[] $params
     */
    public function updateParams(array $params): void
    {
        $this->params = $params;
        $this->message = $this->createMessage();
    }

    public function hasCustomTemplate(): bool
    {
        return $this->getTemplateString() === $this->template;
    }

    private function getTemplateString(): string
    {
        foreach ($this->templates as $template) {
            if ($template->id === $this->template) {
                return $template->{$this->mode};
            }
        }

        return $this->template;
    }

    private function createMessage(): string
    {
        return $this->formatter->format($this->getTemplateString(), $this->input, $this->params);
    }

    public function __toString(): string
    {
        return $this->getMessage();
    }
}
