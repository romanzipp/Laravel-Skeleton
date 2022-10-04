<?php

namespace Domain\User\Nova\Resources;

use App\Nova\Fields\NovaColoredEnumField;
use App\Nova\Fields\NovaEnumSelect;
use App\Nova\Resources\AbstractNovaResource;
use Domain\User\Models\Account;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Support\Enums\ServiceEnum;

class NovaAccount extends AbstractNovaResource
{
    public static string $model = Account::class;

    public static $title = 'name';

    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Name'),
            Text::make('Display Name'),

            NovaColoredEnumField::make('Service', 'service', ServiceEnum::class)->exceptOnForms(),
            NovaEnumSelect::make('Service', 'service', ServiceEnum::class)->required()->onlyOnForms(),

            new Panel('Service', [
                Text::make('Service User Name')->sortable()->required(),
                Text::make('Service User Id'),
            ]),

            URL::make('URL', fn (Account $account) => $account->getExternalServiceUrl() ?? '-')
                ->textAlign('left')
                ->displayUsing(fn (string $url) => $url ? parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH) : '-'),

            BelongsTo::make('User', 'user', NovaUser::class),
        ];
    }
}
