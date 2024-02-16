<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProductDeletedTable extends DataTableComponent
{
    protected $model = Product::class;

    public function builder(): Builder
    {
        $model = new $this->model();
        $query = $model->query();
        if (auth()->guard("admin")->user()->role !== "administrator"){
            $query->where("admin_id", auth()->guard("admin")->user()->id);
        }
        return  $query->onlyTrashed();
    }

    public function bulkActions(): array
    {
        return [
            'restoreSelected' => 'Restore',
        ];
    }

    public function restoreSelected()
    {
        $datas      = $this->getSelected();
        $model      = new $this->model();
        $this->clearSelected();
        $products   = $model->whereIn("id", $datas);
        $products->restore();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setFilterLayoutSlideDown();
        
        $this->setLoadingPlaceholderEnabled();
        $this->setLoadingPlaceHolderIconAttributes([
            'class' => 'lds-hourglass',
            'default' => false,
        ]);
    }

    public function filters(): array
    {
        return [
            DateRangeFilter::make('updated_at')
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('products.updated_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('products.updated_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
            DateRangeFilter::make('created_at')
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('products.created_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('products.created_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
            SelectFilter::make('Status')
            ->options([
                'all' => 'All',
                1 => 'Active',
                0 => 'Non-Active',

            ])->filter(function (Builder $builder, $val) {
                if($val != 'all'){
                    $builder
                        ->where('products.status', $val); // minDate is the start date selected
                }
            }),
            SelectFilter::make('Free Product')
            ->options([
                'all' => 'All',
                1 => 'Free Product',
                0 => 'Paid Product',

            ])->filter(function (Builder $builder, $val) {
                if($val != 'all'){
                    $builder
                        ->where('products.is_free', $val); // minDate is the start date selected
                }
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true)
                ->sortable(),
            Column::make("Product category id", "productCategory.name")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Slug", "slug")
                ->hideIf(true)
                ->sortable(),
            Column::make("Describtion", "describtion")
                ->hideIf(true)
                ->sortable(),
            Column::make("File size", "file_size")
                ->hideIf(true)
                ->sortable(),
            Column::make("File", "file")
                ->hideIf(true)
                ->sortable(),
            Column::make("Price", "price")
                ->format(
                    fn($value, $row, Column $column) =>'<b>'. $row->price.' USD </b>'
                )
                ->html()
                ->sortable(),
            Column::make("Promo", "promo")
                ->hideIf(true)
                ->sortable(),
            BooleanColumn::make("Is free", "is_free")
                ->sortable(),
            BooleanColumn::make("Status", "status")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('components.livewire.datatable-action-column')->with(
                        [
                            'detail' => route("bo.products-trashed.show", $row->slug),
                            'restore'   => route("bo.products-trashed.update", $row->slug),
                            'delete' => route("bo.products-trashed.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
