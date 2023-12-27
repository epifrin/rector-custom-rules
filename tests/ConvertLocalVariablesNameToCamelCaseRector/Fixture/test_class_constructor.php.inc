<?php

class SomeClass
{
    public function __construct(private string $my_variable)
    {
    }

    public function getMyVariable(): string
    {
        return $this->my_variable;
    }
}

?>
-----
<?php

class SomeClass
{
    public function __construct(private string $my_variable)
    {
    }

    public function getMyVariable(): string
    {
        return $this->my_variable;
    }
}

?>
