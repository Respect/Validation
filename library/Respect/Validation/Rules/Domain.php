<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;

class Domain extends AbstractComposite
{
    private $ip,
            $tld,
            $checks = array(),
            $otherParts;

    public function __construct()
    {
        $this->ip = new Ip();
        $this->checks[] = new NoWhitespace();
        $this->checks[] = new Contains('.');
        $this->checks[] = new Not(new Contains('--'));
        $this->checks[] = new Length(3, null);
        $this->tld = new Tld();
        $this->otherParts = new AllOf(
            new Alnum('-'),
            new Not(new StartsWith('-'))
        );
    }

    public function validate($input)
    {
        if ($input === '' || $this->ip->validate($input))
            return true;

        foreach ($this->checks as $chk)
            if (!$chk->validate($input))
                return false;

        if (count($parts = explode('.', $input)) < 2
            || !$this->tld->validate(array_pop($parts)))
            return false;

        foreach ($parts as $p)
            if (!$this->otherParts->validate($p))
                return false;

        return true;
    }

    public function assert($input)
    {
        if ($input === '' || $this->ip->validate($input))
            return true;

        $e = array();
        foreach ($this->checks as $chk)
            $this->collectAssertException($e, $chk, $input);

        if (count($parts = explode('.', $input)) >= 2)
            $this->collectAssertException($e, $this->tld, array_pop($parts));

        foreach ($parts as $p)
            $this->collectAssertException($e, $this->otherParts, $p);

        if (count($e))
            throw $this->reportError($input)->setRelated($e);

        return true;
    }

    protected function collectAssertException(&$exceptions, $validator, $input)
    {
        try {
            $validator->assert($input);
        } catch (ValidationException $e) {
            $exceptions[] = $e;
        }
    }

    public function check($input)
    {
        if ($input === '' || $this->ip->validate($input))
            return true;

        foreach ($this->checks as $chk)
            $chk->check($input);

        if (count($parts = explode('.', $input)) >= 2)
            $this->tld->check(array_pop($parts));

        foreach ($parts as $p)
            $this->otherParts->check($p);

        return true;
    }
}

