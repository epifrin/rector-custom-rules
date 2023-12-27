<?php

class SomeClass
{
    public function someMethod()
    {
        $my_string = "text";
        return $my_string;
    }
}

?>
-----
<?php

class SomeClass
{
    public function someMethod()
    {
        $myString = "text";
        return $myString;
    }
}

?>
