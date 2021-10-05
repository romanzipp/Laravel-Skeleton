<?php

namespace Support\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\Relation;

class Morph
{
    /**
     * Resolve any model by given morph type & id.
     *
     * @param string $type Morph type
     * @param mixed $id Morph id
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function resolve(string $type, $id): ?Model
    {
        if ( ! $class = self::typeToClass($type)) {
            return null;
        }

        return $class::query()->find($id);
    }

    /**
     * Resolve any model by given morph type & id or throw an exception.
     *
     * @param string $type Morph type
     * @param mixed $id Morph id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function resolveOrFail(string $type, $id): Model
    {
        if ( ! ($model = self::resolve($type, $id))) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    /**
     * Convert given Morph type to class.
     *
     * @param string $type Morph type
     *
     * @return string|null
     */
    public static function typeToClass(string $type): ?string
    {
        return Relation::getMorphedModel($type);
    }

    /**
     * Convert given class to possible morph type.
     *
     * @param string $class
     *
     * @return string
     */
    public static function classToType(string $class): string
    {
        if (in_array($class, Relation::$morphMap)) {
            return array_search($class, Relation::$morphMap);
        }

        return $class;
    }

    /**
     * Convert a given value to morph type.
     *
     * @param mixed $class
     *
     * @return string
     */
    public static function toType($class): string
    {
        if ($class instanceof Model) {
            return self::classToType(get_class($class));
        }

        return self::classToType($class);
    }
}
