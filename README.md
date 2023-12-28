# Rector Custom Rules
These are three rector rules to convert private method name, to convert local variable name to camel case and to replace double quotes with single quotes in string literals.

[![Build status](https://github.com/epifrin/rector-custom-rules/actions/workflows/build.yml/badge.svg)](https://github.com/epifrin/rector-custom-rules/actions/workflows/build.yml)
[![Latest Stable Version](http://poser.pugx.org/epifrin/rector-custom-rules/v)](https://packagist.org/packages/epifrin/rector-custom-rules)
[![PHP Version Require](http://poser.pugx.org/epifrin/rector-custom-rules/require/php)](https://packagist.org/packages/epifrin/rector-custom-rules)
[![Total Downloads](http://poser.pugx.org/epifrin/rector-custom-rules/downloads)](https://packagist.org/packages/epifrin/rector-custom-rules)
[![License](http://poser.pugx.org/epifrin/rector-custom-rules/license)](https://packagist.org/packages/epifrin/rector-custom-rules)

## Installation
```bash
composer require --dev epifrin/rector-custom-rules
```

## Usage
Add the following to your rector config:

```php
$rectorConfig->rule(\Epifrin\RectorCustomRules\RectorRules\ConvertPrivateMethodsNameToCamelCaseRector::class);
$rectorConfig->rule(\Epifrin\RectorCustomRules\RectorRules\ConvertLocalVariablesNameToCamelCaseRector::class);
$rectorConfig->rule(\Epifrin\RectorCustomRules\RectorRules\ReplaceDoubleQuotesWithSingleRector::class);
```

## Rector rules

### Convert local variable names to camel case
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

### Convert private method names to camel case
Why only private methods? Because it's safer to change private method names than public or protected method names.

```diff
class SomeClass 
{
    public function publicMethod() 
    {
-        $this->my_private_method();
+        $this->myPrivateMethod();

-        self::my_static_private_method();
+        self::myStaticPrivateMethod();
    }
    
-    private function my_private_method() {}
+    private function myPrivateMethod() {}

-    private static function my_static_private_method() {}
+    private static function myStaticPrivateMethod() {}
}
```

### Replace double quotes with single
This rule replaces double quotes with single quotes in string literals. It does not replace double quotes if the string literal contains variables or substitutions.

Here is an example of how this rule works:

```diff
class SomeClass
{
    public function someMethod()
    {
-        $string = "This is a simple string";
+        $string = 'This is a simple string';

-        $stringWithVariable = "Hello, $name";
+        $stringWithVariable = "Hello, $name";

-        $stringWithSpecialChar = "String with special char: \n";
+        $stringWithSpecialChar = "String with special char: \n";
    }
}