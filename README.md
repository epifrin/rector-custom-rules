# Rector Custom Rules
Now these are two rector rules to convert private method name and local variable name to camel case

## Convert local variable's name to camel case
```diff
class SomeClass 
{
    public function aMethod() 
    {
-        $my_variable = 1;
+        $myVariable = 1;

-        return $my_variable;
+        return $myVariable;
    }
}
```

## Convert private method's name to camel case
Why only private method? Because it's more safe to change private method's name than public method's name.

```diff
class SomeClass 
{
    public function publicMethod() 
    {
-        $this->my_private_method();
+        $this->myPrivateMethod();
    }
    
-    private function my_private_method() {}
+    private function myPrivateMethod() {}
}
```