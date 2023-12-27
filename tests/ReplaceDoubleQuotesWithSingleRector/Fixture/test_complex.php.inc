<?php

class SomeClass
{
    public function someMethod(string $name)
    {
        return "Some string $name" . 'Some string' . $name . "Some";
    }
}

?>
-----
<?php

class SomeClass
{
    public function someMethod(string $name)
    {
        return "Some string $name" . 'Some string' . $name . 'Some';
    }
}

?>
