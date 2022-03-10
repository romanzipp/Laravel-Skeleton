<?php

namespace Domain\User\Nova\Resources;

use App\Nova\Resources\AbstractNovaResource;
use Domain\User\Models\User;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class NovaUser extends AbstractNovaResource
{
    public static string $model = User::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'email',
    ];

    /**
     * @var \Domain\User\Models\User
     */
    public $resource;

    public static function label(): string
    {
        return 'Users';
    }

    public static function singularLabel(): string
    {
        return 'User';
    }

    public function fields(Request $request): array
    {
        $table = self::getTableName();

        return [
            ID::make()->sortable(),

            Images::make('Avatar'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Display Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules("unique:$$table,email")
                ->updateRules("unique:$$table,email,{{resourceId}}"),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
        ];
    }
}
