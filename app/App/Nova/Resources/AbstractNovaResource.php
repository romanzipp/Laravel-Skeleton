<?php

namespace App\Nova\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use RuntimeException;

abstract class AbstractNovaResource extends Resource
{
    public static array $defaultSort = ['created_at' => 'desc'];

    public static int $sidebarOrder = 0;

    abstract public function fields(Request $request): array;

    public static function label()
    {
        return trim(str_replace('Nova', '', parent::label()));
    }

    protected static function applyOrderings($query, array $orderings): Builder
    {
        $orderings = array_filter($orderings);

        if (empty($orderings)) {
            if (empty($query->getQuery()->orders) && ! static::usesScout()) {
                foreach (static::$defaultSort as $col => $dir) {
                    $query->orderBy($col, $dir);
                }

                return $query;
            }

            return $query;
        }

        foreach ($orderings as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }

    public function getTableName(): string
    {
        /** @var \Support\Models\AbstractModel|null $model */
        $model = $this->model();

        if ($model ===null){
            throw new RuntimeException('Model is not available for ' . static::class);
        }

        return $model::getTableName();
    }

    public static function indexQuery(NovaRequest $request, $builder): Builder
    {
        return $builder;
    }

    public static function detailQuery(NovaRequest $request, $builder): Builder
    {
        return parent::detailQuery($request, $builder);
    }

    public static function relatableQuery(NovaRequest $request, $builder): Builder
    {
        return parent::relatableQuery($request, $builder);
    }
}
