<?php

class SomeClass
{
    public function someMethod()
    {
        $string = "This text contains \n a new line";
        $string .= "This text contains \t a tab";
        $string .= "This text contains \r a carriage return";
        $string .= "This text contains \v a vertical tab";
        return $string;
    }
}

?>
-----
<?php

class SomeClass
{
    public function someMethod()
    {
        $string = "This text contains \n a new line";
        $string .= "This text contains \t a tab";
        $string .= "This text contains \r a carriage return";
        $string .= "This text contains \v a vertical tab";
        return $string;
    }
}

?>
