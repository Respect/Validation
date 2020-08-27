<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;
use Respect\Validation\Message\Formatter;

use function key;

/**
 * Default exception class for rule validations.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class ValidationException extends InvalidArgumentException implements Exception
{
    public const MODE_DEFAULT = 'default';
    public const MODE_NEGATIVE = 'negative';
    public const STANDARD = 'standard';

    /**
     * Contains the default templates for exception message.
     *
     * @var string[][]
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be valid',
        ],
    ];

    /**
     * @var mixed
     */
    private $input;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $mode = self::MODE_DEFAULT;

    /**
     * @var mixed[]
     */
    private $params = [];

    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * @var string
     */
    private $template;

    /**
     * @param mixed $input
     * @param mixed[] $params
     */
    public function __construct($input, string $id, array $params, Formatter $formatter)
    {
        $this->input = $input;
        $this->id = $id;
        $this->params = $params;
        $this->formatter = $formatter;
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

    /**
     * @return mixed|null
     */
    public function getParam(string $name)
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
