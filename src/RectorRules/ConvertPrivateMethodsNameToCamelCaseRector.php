<?php

namespace Epifrin\RectorCustomRules;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ConvertPrivateMethodsNameToCamelCaseRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [ClassMethod::class, StaticCall::class, MethodCall::class];
    }

    /**
     * @param ClassMethod|StaticCall|MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof ClassMethod) {
            return $this->refactorMethodDeclaration($node);
        }

        if ($node instanceof MethodCall) {
            return $this->refactorMethodCall($node);
        }

        if ($node instanceof StaticCall) {
            return $this->refactorStaticCall($node);
        }

        return null;
    }

    private function refactorMethodDeclaration(ClassMethod $node): ?Node
    {
        if (!$node->isPrivate()) {
            return null;
        }

        $oldName = $node->name->toString();
        $newName = $this->toCamelCase($oldName);

        if ($oldName === $newName) {
            return null; // Skip if the name is already in camelCase
        }

        $node->name = new Node\Identifier($newName);

        return $node;
    }

    private function refactorMethodCall(MethodCall $node): ?Node
    {
        if (!($node->var instanceof Node\Expr\Variable) || $node->var->name !== 'this') {
            return null;
        }

        $methodCallName = $this->getName($node->name);
        $newMethodCallName = $this->toCamelCase($methodCallName);

        if ($methodCallName === $newMethodCallName) {
            return null; // Skip if the name is already in camelCase
        }

        $node->name = new Node\Identifier($newMethodCallName);

        return $node;
    }

    private function refactorStaticCall(StaticCall $node): ?Node
    {
        if ($node->class instanceof Node\Name && $node->class->toString() === 'self') {
            $methodCallName = $this->getName($node->name);
            $newMethodCallName = $this->toCamelCase($methodCallName);

            if ($methodCallName === $newMethodCallName) {
                return null; // Skip if the name is already in camelCase
            }

            $node->name = new Node\Identifier($newMethodCallName);
        }

        return $node;
    }

    private function toCamelCase(string $str): string
    {
        $words = explode(' ', preg_replace(['-', '_'], ' ', $str));

        $studlyWords = array_map(fn($word) => ucfirst($word), $words);

        return lcfirst(implode($studlyWords));
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Converts the names of private methods to camelCase', [
            new CodeSample(
                <<<'CODE_SAMPLE'
class MyClass
{
private function is_snake_case()
{
// Some code here
}
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class MyClass
{
private function isSnakeCase()
{
// Some code here
}
}
CODE_SAMPLE
            ),
        ]);
    }
}
