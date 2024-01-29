<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Validatable;

use function key;

class ValidationException extends InvalidArgumentException implements Exception
{
    public const MODE_DEFAULT = 'default';
    public const MODE_NEGATIVE = 'negative';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            Validatable::TEMPLATE_STANDARD => '{{name}} must not be valid',
        ],
    ];

    private string $mode = self::MODE_DEFAULT;

    /**
     * @param mixed[] $params
     */
    public function __construct(
        private readonly mixed $input,
        private readonly string $id,
        private array $params,
        private string $template,
        private readonly Formatter $formatter
    ) {
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
        return isset($this->defaultTemplates[$this->mode][$this->template]) === false;
    }

    protected function getTemplate(): string
    {
        return (string) key($this->defaultTemplates[$this->mode]);
    }

    private function createMessage(): string
    {
        return $this->formatter->format(
            $this->defaultTemplates[$this->mode][$this->template] ?? $this->template,
            $this->input,
            $this->params
        );
    }

    public function __toString(): string
    {
        return $this->getMessage();
    }
}
