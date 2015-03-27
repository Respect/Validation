<?php
namespace Respect\Validation\Exceptions;

class AbstractGroupedException extends AbstractNestedException
{
    const NONE = 0;
    const SOME = 1;

    public function chooseTemplate()
    {
        $numRules = $this->getParam('passed');
        $numFailed = count($this->getRelated());

        return $numRules === $numFailed ? static::NONE : static::SOME;
    }

    public function getParams()
    {
        if (1 === count($this->related)) {
            return current($this->related)->getParams();
        } else {
            return parent::getParams();
        }
    }

    public function getTemplate()
    {
        $parentTemplate = parent::getTemplate();
        $isEmpty = empty($this->template);

        if (!$isEmpty && $this->template != $parentTemplate) {
            return $this->template;
        }
        if ($isEmpty && 1 === count($this->related)) {
            return current($this->related)->getTemplate();
        } else {
            return $parentTemplate;
        }
    }
}
