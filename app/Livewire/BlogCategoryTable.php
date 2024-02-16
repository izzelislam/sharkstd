<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BlogCategory;
use App\Services\BlogCategory\BlogCategoryService;

class BlogCategoryTable extends DataTableComponent
{
    protected $model   = BlogCategory::class;

    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Delete',
        ];
    }

    public function deleteSelected()
    {
        $datas      = $this->getSelected();
        $this->clearSelected();
        BlogCategory::destroy($datas);
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
                            'detail' => route("bo.blog-categories.show", $row->slug),
                            'edit'   => route("bo.blog-categories.edit", $row->slug),
                            'delete' => route("bo.blog-categories.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
