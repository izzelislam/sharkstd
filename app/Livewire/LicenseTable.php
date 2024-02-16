<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\License;

class LicenseTable extends DataTableComponent
{
    protected $model = License::class;

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
                ->hideIf(true)
                ->sortable(),
            Column::make("Slug", "slug")
                ->sortable(),
            Column::make("Describtion", "describtion")
                ->sortable(),
            Column::make("Price", "price")
                ->format(
                    fn($value, $row, Column $column) =>'<b>'. $row->price.' USD </b>'
                )
                ->html()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('components.livewire.datatable-action-column')->with(
                        [
                            'detail' => route("bo.licenses.show", $row->slug),
                            'edit'   => route("bo.licenses.edit", $row->slug),
                            'delete' => route("bo.licenses.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
