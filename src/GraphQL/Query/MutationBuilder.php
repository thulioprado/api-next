<?php

declare(strict_types=1);

namespace Directus\GraphQL\Query;

use Directus\Contracts\GraphQL\Engine;
use Directus\Contracts\GraphQL\Query\MutationBuilder as MutationBuilderContract;
use Directus\GraphQL\Types\Types;
use GraphQL\Executor\ExecutionResult;
use GraphQL\Language\AST\ArgumentNode;
use GraphQL\Language\AST\DocumentNode;
use GraphQL\Language\AST\FieldNode;
use GraphQL\Language\AST\NameNode;
use GraphQL\Language\AST\OperationDefinitionNode;
use GraphQL\Language\AST\SelectionSetNode;
use GraphQL\Language\AST\VariableDefinitionNode;
use GraphQL\Language\AST\VariableNode;
use GraphQL\Language\Printer;

class MutationBuilder implements MutationBuilderContract
{
    /**
     * @var Engine
     */
    protected $engine;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $alias;

    /**
     * @var null|array
     */
    protected $fields;

    /**
     * Constructor.
     */
    public function __construct(Engine $engine, string $name, ?string $alias = null)
    {
        $this->engine = $engine;
        $this->name = $name;
        $this->alias = $alias;
    }

    public function value(): self
    {
        $this->fields = null;

        return $this;
    }

    public function select(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function as(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Executes the mutation.
     *
     * @throws \Exception
     */
    public function execute(array $args = []): ExecutionResult
    {
        $schema = $this->engine->schema();
        $field = $schema->getMutationType()->getField($this->name);

        $variables = [];
        foreach ($args as $key => $value) {
            $argument = $field->getArg($key);
            $variables[] = new VariableDefinitionNode([
                'type' => Types::typeToNode($argument->getType()),
                'variable' => new VariableNode([
                    'name' => new NameNode([
                        'value' => $argument->name,
                    ]),
                ]),
            ]);
        }

        $arguments = [];
        foreach ($args as $key => $value) {
            $arguments[] = new ArgumentNode([
                'name' => new NameNode([
                    'value' => $key,
                ]),
                'value' => new VariableNode([
                    'name' => new NameNode([
                        'value' => $key,
                    ]),
                ]),
            ]);
        }

        $selectedFields = null;

        if ($this->fields !== null) {
            $selectedFieldList = [];

            foreach ($this->fields as $field) {
                $selectedFieldList[] = new FieldNode([
                    'name' => new NameNode([
                        'value' => $field,
                    ]),
                ]);
            }

            $selectedFields = new SelectionSetNode([
                'selections' => $selectedFieldList,
            ]);
        }

        $document = new DocumentNode([
            'definitions' => [
                new OperationDefinitionNode([
                    'operation' => 'mutation',
                    'variableDefinitions' => $variables,
                    'selectionSet' => new SelectionSetNode([
                        'selections' => [
                            new FieldNode([
                                'name' => new NameNode([
                                    'value' => $this->name,
                                ]),
                                'alias' => $this->alias === null ? null : new NameNode([
                                    'value' => $this->alias,
                                ]),
                                'arguments' => $arguments,
                                'selectionSet' => $selectedFields,
                            ]),
                        ],
                    ]),
                ]),
            ],
        ]);

        $query = Printer::doPrint($document);

        return $this->engine->execute($query, $args);
    }
}
