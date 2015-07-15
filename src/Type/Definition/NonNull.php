<?php
namespace GraphQL\Type\Definition;

use GraphQL\Type\TypeKind;
use GraphQL\Utils;

class NonNull extends Type implements WrappingType, OutputType, InputType
{
    /**
     * @var callable|Type
     */
    protected $ofType;

    /**
     * @param callable|Type $type
     * @throws \Exception
     */
    public function __construct($type)
    {
        Utils::invariant(
            $type instanceof Type || is_callable($type),
            'Expecting instance of GraphQL\Type\Definition\Type or callable returning instance of that class'
        );
        Utils::invariant(
            !($type instanceof NonNull),
            'Cannot nest NonNull inside NonNull'
        );
        $this->ofType = $type;
    }

    /**
     * @return Type|callable
     */
    public function getWrappedType()
    {
        $type = Type::resolve($this->ofType);

        Utils::invariant(
            !($type instanceof NonNull),
            'Cannot nest NonNull inside NonNull'
        );

        return $type;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->getWrappedType()->toString() . '!';
    }
}
