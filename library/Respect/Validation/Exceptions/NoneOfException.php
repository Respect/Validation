<?php

namespace Respect\Validation\Exceptions;

class NoneOfException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::STANDARD => 'None of these rules must pass for {{name}}',
    );
    
    public function chooseTemplate() {
        return 0;
    }

}
