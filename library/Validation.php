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

namespace Respect\Validation;

use RecursiveIteratorIterator;

/**
 * Represents the product of a validation.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Validation
{
    /**
     * @var Result
     */
    private $result;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var string
     */
    private $locale;

    /**
     * Initializes the object.
     *
     * @param Result  $result
     * @param Factory $factory
     * @param string  $locale
     */
    public function __construct(Result $result, Factory $factory, string $locale)
    {
        $this->result = $result;
        $this->factory = $factory;
        $this->locale = $locale;
    }

    public function __toString(): string
    {
        return $this->getFullMessage()->__toString();
    }

    public function isValid(): bool
    {
        return $this->result->isValid();
    }

    public function getMessages(): array
    {
        return $this->createMessages($this->result);
    }

    public function getRootMessage(): Message
    {
        return $this->factory->message($this->result);
    }

    public function getMainMessage(): Message
    {
        return current($this->getMessages());
    }

    public function getFullMessage(): Message
    {
        $messages = ['- '.$this->factory->message($this->result)->__toString()];
        $iterator = new RecursiveIteratorIterator(
            new ResultRecursiveIterator($this->result),
            RecursiveIteratorIterator::SELF_FIRST
        );
        $lastDepth = 0;
        $lastDepthOriginal = 0;
        $lastStringKey = null;
        $knownDepths = [];
        /* @var Result $childResult */
        foreach ($iterator as $childKey => $childResult) {
            if ($childResult->isValid()) {
                continue;
            }

            $message = $this->factory->message($childResult);
            $childrenCount = count($iterator->callGetChildren());

            if (1 == $childrenCount) {
                $lastStringKey = is_string($childKey) ? $childKey : null;
                continue;
            }

            $currentDepth = $lastDepth;
            $currentDepthOriginal = $iterator->getDepth() + 1;

            if (isset($knownDepths[$currentDepthOriginal])) {
                $currentDepth = $knownDepths[$currentDepthOriginal];
            } elseif ($currentDepthOriginal > $lastDepthOriginal && 1 != $childrenCount) {
                ++$currentDepth;
            }

            if (!isset($knownDepths[$currentDepthOriginal])) {
                $knownDepths[$currentDepthOriginal] = $currentDepth;
            }

            $lastDepth = $currentDepth;
            $lastDepthOriginal = $currentDepthOriginal;

            $placeholder = null;
            if ($lastDepth <= $currentDepth && is_string($lastStringKey)) {
                $placeholder = sprintf('"%s"', $lastStringKey);
            }

            $messages[] = sprintf(
                '%s- %s',
                str_repeat(' ', $currentDepth * 2),
                $message->render($placeholder)
            );

            $lastStringKey = is_string($childKey) ? $childKey : null;
        }

        if (2 === count($messages)) {
            $messages = [trim(array_pop($messages))];
        }

        return new Message('Validation', implode(PHP_EOL, $messages), $this->result->getInput());
    }

    private function createMessages(Result $result): array
    {
        $key = spl_object_hash($result);
        $message = $this->factory->message($result);
        $messages = [$key => $message];
        foreach (new ResultIterator($result) as $childKey => $childResult) {
            if ($childResult->isValid()) {
                continue;
            }

            if (!is_string($childKey)) {
                $childKey = spl_object_hash($childResult);
            }

            $childMessage = $this->factory->message($childResult);

            if (!$childResult->hasChildren()) {
                $messages[$childKey] = $childMessage;
                continue;
            }

            $messages[$childKey] = $this->createMessages($childResult);
            if (count($messages[$childKey]) > 1) {
                continue;
            }

            $messages[$childKey] = current($messages[$childKey]);
        }

        if (count($messages) > 1) {
            unset($messages[$key]);
        }

        return $messages;
    }
}
