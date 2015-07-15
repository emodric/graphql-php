<?php
namespace GraphQL\Type\Definition;

use GraphQL\Language\AST\IntValue;
use GraphQL\Language\AST\StringValue;

class IDType extends ScalarType
{
    public $name = 'ID';

    public function coerce($value)
    {
        return (string) $value;
    }

    public function coerceLiteral($ast)
    {
        if ($ast instanceof StringValue || $ast instanceof IntValue) {
            return $ast->value;
        }
        return null;
    }
}
