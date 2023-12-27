<?php

class SomeClass
{
    private string $my_var;

    public function __construct(string $my_var, string $my_var2)
    {
        $this->my_var = $my_var . $my_var2;
    }

    public function getMyVar(): string
    {
        return $this->my_var;
    }
}

?>
-----
<?php

class SomeClass
{
    private string $my_var;

    public function __construct(string $my_var, string $myVar2)
    {
        $this->my_var = $my_var . $myVar2;
    }

    public function getMyVar(): string
    {
        return $this->my_var;
    }
}

?>
