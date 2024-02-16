<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Feature;

class FeatureTable extends DataTableComponent
{
    protected $model = Feature::class;

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Delete',
        ];
    }

    public function deleteSelected()
    {
        $datas      = $this->getSelected();
        $model      = new $this->model();
        $this->clearSelected();
        $model->destroy($datas);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
                            'detail' => route("bo.features.show", $row->slug),
                            'edit'   => route("bo.features.edit", $row->slug),
                            'delete' => route("bo.features.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
