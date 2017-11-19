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

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

class KeyValue extends AbstractRule
{
    public $comparedKey;
    public $ruleName;
    public $baseKey;

    public function __construct($comparedKey, $ruleName, $baseKey)
    {
        $this->comparedKey = $comparedKey;
        $this->ruleName = $ruleName;
        $this->baseKey = $baseKey;
    }

    private function getRule($input)
    {
        if (!isset($input[$this->comparedKey])) {
            throw $this->reportError($this->comparedKey);
        }

        if (!isset($input[$this->baseKey])) {
            throw $this->reportError($this->baseKey);
        }

        try {
            $rule = Validator::__callStatic($this->ruleName, [$input[$this->baseKey]]);
            $rule->setName($this->comparedKey);
        } catch (ComponentException $exception) {
            throw $this->reportError($input, ['component' => true]);
        }

        return $rule;
    }

    private function overwriteExceptionParams(ValidationException $exception)
    {
        $params = [];
        foreach ($exception->getParams() as $key => $value) {
            if (in_array($key, ['template', 'translator'])) {
                continue;
            }

            $params[$key] = $this->baseKey;
        }

        $exception->configure($this->comparedKey, $params);

        return $exception;
    }

    public function assert($input)
    {
        $rule = $this->getRule($input);

        try {
            $rule->assert($input[$this->comparedKey]);
        } catch (ValidationException $exception) {
            throw $this->overwriteExceptionParams($exception);
        }

        return true;
    }

    public function check($input)
    {
        $rule = $this->getRule($input);

        try {
            $rule->check($input[$this->comparedKey]);
        } catch (ValidationException $exception) {
            throw $this->overwriteExceptionParams($exception);
        }

        return true;
    }

    public function validate($input)
    {
        try {
            $rule = $this->getRule($input);
        } catch (ValidationException $e) {
            return false;
        }

        return $rule->validate($input[$this->comparedKey]);
    }
}
