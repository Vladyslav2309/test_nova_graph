<?php

namespace App\Nova;

use App\Nova\Filters\ProductBrand;
use App\Nova\Metrics\AveragePrice;
use App\Nova\Metrics\NewProducts;
use App\Nova\Metrics\ProductsPerDay;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Kongulov\NovaTabTranslatable\TranslatableTabToRowTrait;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\NovaRequest;
use Murdercode\TinymceEditor\TinymceEditor;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Product extends Resource
{
    use HasSortableRows, TranslatableTabToRowTrait;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description', 'sku',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

            Text::make('Slug')
                ->hideFromIndex(),

            NovaTabTranslatable::make([
                Text::make('Name'),
            ])
                ->textAlign('left')
                ->setTitle('Name')
                ->showOnPreview()
                ->sortable(),

            NovaTabTranslatable::make([

                TinymceEditor::make(__('Description'), 'description')
                    ->fullWidth(),
            ])->setTitle('Description')
                ->showOnPreview(),

            Currency::make('Price')->currency('UAH')
                ->textAlign('left')
                ->showOnPreview()
                ->sortable(),

            Text::make('Sku')
                ->textAlign('left')
                ->showOnPreview(),
            Number::make('Quantity')
                ->textAlign('center')
                ->showOnPreview()
                ->sortable(),
            Boolean::make('Status', 'is_published')
                ->sortable(),

            BelongsTo::make('Brand')
                ->textAlign('left')
            ->sortable()
            ->showOnPreview(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new NewProducts(),
            new AveragePrice(),
            new ProductsPerDay()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new ProductBrand()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
