<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;
use Respect\Validation\Message\Formatter;

use function key;

class ValidationException extends InvalidArgumentException implements Exception
{
    public const MODE_DEFAULT = 'default';
    public const MODE_NEGATIVE = 'negative';
    public const STANDARD = 'standard';

    /**
     * @var array<string, array<string, string>>
     */
    protected array $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be valid',
        ],
    ];

    private string $mode = self::MODE_DEFAULT;

    private string $template;

    /**
     * @param mixed[] $params
     */
    public function __construct(
        private mixed $input,
        private string $id,
        private array $params,
        private Formatter $formatter
    ) {
        $this->template = $this->chooseTemplate();

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

    public function setParam(string $name, mixed $value): void
    {
        $this->params[$name] = $value;
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

    protected function chooseTemplate(): string
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
