<?php

namespace Respect\Validation\Exceptions;

class AbstractRelatedException extends AbstractCompositeException
{

    public function chooseTemplate()
    {
        return 0;
    }

    //TODO cleanup this inheritances
    public function getRelated($full=false)
    {
        return $this->related;
    }

    //TODO cleanup this inheritances
    public function getParams()
    {
        return $this->params;
    }

    //TODO cleanup this inheritances
    public function getTemplate()
    {
        if (!empty($this->template))
            return $this->template;
        $templateKey = $this->chooseTemplate();
        if (is_null($this->context))
            $this->template = static::$defaultTemplates[$templateKey];
        else
            $this->template = $this->context->getTemplate($this, $templateKey);
        return $this->template;
    }

}
