<?php

namespace Epifrin\RectorCustomRules;

use PhpParser\Node;
use PhpParser\Node\Expr\Variable;
use Rector\Core\Php\ReservedKeywordAnalyzer;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ConvertLocalVariablesNameToCamelCaseRector extends AbstractRector
{
    public function __construct(
        private ReservedKeywordAnalyzer $reservedKeywordAnalyzer,
    ) {
    }

    public function getNodeTypes(): array
    {
        return [Variable::class];
    }

    /**
     * @param Variable $node
     * @return Node|null
     */
    public function refactor(Node $node): ?Node
    {
        $currentName = $node->name;

        if ($this->reservedKeywordAnalyzer->isNativeVariable($currentName)) {
            return null;
        }

        $newName = $this->toCamelCase($currentName);

        if ($newName === 'this') {
            return null;
        }

        if ($newName === '') {
            return null;
        }

        if ($currentName === $newName) {
            return null; // Skip if the name is already in camelCase
        }

        $node->name = $newName;

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Converts the names of local variables to camelCase', [
            new CodeSample(
            // code before
                '$my_variable = 1;',
                // code after
                '$myVariable = 1;'
            ),
        ]);
    }

    private function toCamelCase(string $str): string
    {
        $words = explode(' ', preg_replace(['-', '_'], ' ', $str));

        $studlyWords = array_map(fn($word) => ucfirst($word), $words);

        return lcfirst(implode($studlyWords));
    }
}
