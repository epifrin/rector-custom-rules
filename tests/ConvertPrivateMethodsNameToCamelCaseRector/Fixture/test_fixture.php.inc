<?php

class MyClass
{
    public function do()
    {
        return $this->is_snake_case();
    }

    private function is_snake_case()
    {
        // Some code here
    }
}

?>
-----
<?php

class MyClass
{
    public function do()
    {
        return $this->isSnakeCase();
    }

    private function isSnakeCase()
    {
        // Some code here
    }
}

?>
