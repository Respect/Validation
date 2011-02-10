<?php

namespace Respect\Validation\Exceptions;

class AtLeastException extends AbstractCompositeException
{

    public static $defaultTemplates = array(
        self::NONE => 'At least {{howMany}} of the {{failed}} required rules must pass for {{name}}',
        self::SOME => 'At least {{howMany}} of the {{failed}} required rules must pass for {{name}}, only {{passed}} passed.',
    );

}
