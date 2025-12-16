--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'tests/bootstrap.php';

use Respect\Validation\Validator as v;

set_mock_is_uploaded_file_return(false);
exceptionMessage(static fn() => v::uploaded()->check('filename'));
set_mock_is_uploaded_file_return(true);
exceptionMessage(static fn() => v::not(v::uploaded())->check('filename'));
set_mock_is_uploaded_file_return(false);
exceptionFullMessage(static fn() => v::uploaded()->assert('filename'));
set_mock_is_uploaded_file_return(true);
exceptionFullMessage(static fn() => v::not(v::uploaded())->assert('filename'));?>
--EXPECT--
"filename" must be an uploaded file
"filename" must not be an uploaded file
- "filename" must be an uploaded file
- "filename" must not be an uploaded file
