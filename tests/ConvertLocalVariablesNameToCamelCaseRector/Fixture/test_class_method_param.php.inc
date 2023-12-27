<?php

class SomeClass
{
    private string $my_prop = 'text';

    public function someMethod(string $simple_string)
    {
        return $this->my_prop . $simple_string;
    }
}

?>
-----
<?php

class SomeClass
{
    private string $my_prop = 'text';

    public function someMethod(string $simpleString)
    {
        return $this->my_prop . $simpleString;
    }
}

?>
