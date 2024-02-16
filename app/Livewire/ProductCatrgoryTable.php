<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ProductCategory;

class ProductCatrgoryTable extends DataTableComponent
{
    protected $model = ProductCategory::class;

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'exportSelected' => 'Export',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true)
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Slug", "slug")
                ->hideIf(true)
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('components.livewire.datatable-action-column')->with(
                        [
                            'detail' => route("bo.product-categories.show", $row->slug),
                            'edit'   => route("bo.product-categories.edit", $row->slug),
                            'delete' => route("bo.product-categories.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
