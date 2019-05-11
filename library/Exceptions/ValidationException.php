<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;
use function call_user_func;
use function is_string;
use function key;
use function preg_replace_callback;
use function Respect\Stringifier\stringify;

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
     * @var callable
     */
    private $translator;

    /**
     * @var string
     */
    private $template;

    /**
     * @param mixed $input
     * @param mixed[] $params
     */
    public function __construct($input, string $id, array $params, callable $translator)
    {
        $this->input = $input;
        $this->id = $id;
        $this->params = $params;
        $this->translator = $translator;
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

    public function __toString(): string
    {
        return $this->getMessage();
    }

    protected function chooseTemplate(): string
    {
        return (string) key($this->defaultTemplates[$this->mode]);
    }

    private function createMessage(): string
    {
        $template = $this->createTemplate($this->mode, $this->template);
        $params = $this->getParams();
        $params['name'] = $params['name'] ?? stringify($this->input);
        $params['input'] = $this->input;

        return $this->format($template, $params);
    }

    private function createTemplate(string $mode, string $template): string
    {
        if (isset($this->defaultTemplates[$mode][$template])) {
            $template = $this->defaultTemplates[$mode][$template];
        }

        return call_user_func($this->translator, $template);
    }

    /**
     * @param mixed[] $vars
     */
    private function format(string $template, array $vars = []): string
    {
        return preg_replace_callback(
            '/{{(\w+)}}/',
            static function ($match) use ($vars) {
                if (!isset($vars[$match[1]])) {
                    return $match[0];
                }

                $value = $vars[$match[1]];
                if ($match[1] == 'name' && is_string($value)) {
                    return $value;
                }

                return stringify($value);
            },
            $template
        );
    }
}
