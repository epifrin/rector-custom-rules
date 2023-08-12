<?php
declare(strict_types=1);

namespace Epifrin\RectorCustomRules\RectorRules;

use Epifrin\RectorCustomRules\Helpers\StringHelper;
use PhpParser\Node;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassLike;
use Rector\Core\Php\ReservedKeywordAnalyzer;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ConvertLocalVariablesNameToCamelCaseRector extends AbstractRector
{
    private array $properties = [];

    public function __construct(
        private ReservedKeywordAnalyzer $reservedKeywordAnalyzer,
    ) {
    }

    public function getNodeTypes(): array
    {
        return [Class_::class, Variable::class];
    }

    /**
     * @param Variable|ClassLike $node
     * @return Node|null
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof ClassLike) {
            foreach ($node->getProperties() as $property) {
                if (isset($property->props[0])) {
                    $this->properties[] = $property->props[0]->name->toString();
                }
            }
            return null;
        }

        return $this->processVariable($node);
    }

    private function processVariable(Variable $node): ?Node
    {
        $currentName = $node->name;

        if ($this->reservedKeywordAnalyzer->isNativeVariable($currentName)) {
            return null;
        }

        if ($currentName === 'this') {
            return null;
        }

        // Skip the variable if its name corresponds to a property name, as this could potentially lead to the construction of property promotion.
        if (in_array($currentName, $this->properties, true)) {
            return null;
        }

        $newName = StringHelper::toCamelCase($currentName);

        if ($newName === '') {
            return null;
        }

        // Skip if the name is already in camelCase
        if ($currentName === $newName) {
            return null;
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
}
