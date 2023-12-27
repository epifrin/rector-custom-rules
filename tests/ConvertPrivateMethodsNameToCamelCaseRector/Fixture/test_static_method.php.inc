<?php

class MyClass
{
    public static function do()
    {
        return self::is_snake_case();
    }

    private static function is_snake_case()
    {
        // Some code here
    }
}

?>
-----
<?php

class MyClass
{
    public static function do()
    {
        return self::isSnakeCase();
    }

    private static function isSnakeCase()
    {
        // Some code here
    }
}

?>
