<?php

class SomeClass
{
    public function someMethod(string $name)
    {
        $string = "Some string $name";
        $string .= 'Some string';
        $string .= $name;
        $string .= "Some";
        return $string;
    }
}

?>
-----
<?php

class SomeClass
{
    public function someMethod(string $name)
    {
        $string = "Some string $name";
        $string .= 'Some string';
        $string .= $name;
        $string .= 'Some';
        return $string;
    }
}

?>
