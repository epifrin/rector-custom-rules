<?php

function someMethod(string $name)
{
    $string1 = "Hello, $name";
    $string2 = "The date is {date('Y-m-d')}";
    $string3 = "This is a simple string";
    $string4 = "This is a 'simple' string";
    $string5 = "This is a '{simple}' string";

    return [$string1, $string2, $string3, $string4, $string5];
}

?>
-----
<?php

function someMethod(string $name)
{
    $string1 = "Hello, $name";
    $string2 = "The date is {date('Y-m-d')}";
    $string3 = 'This is a simple string';
    $string4 = "This is a 'simple' string";
    $string5 = "This is a '{simple}' string";

    return [$string1, $string2, $string3, $string4, $string5];
}

?>
