<?php

namespace App\Livewire;

use App\Helpers\UploadFile;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tool;
use Illuminate\Support\Facades\Storage;

class ToolTable extends DataTableComponent
{
    protected $model = Tool::class;

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
        $images     = $model->whereIn("id", $datas)->pluck("image");
        UploadFile::files_delete($images->toArray());
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
            Column::make("Image", "image")
                ->format(
                    fn($value, $row, Column $column) =>'<img style="width:50px;" src='.Storage::url($row->image).' />'
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
                            'detail' => route("bo.tools.show", $row->slug),
                            'edit'   => route("bo.tools.edit", $row->slug),
                            'delete' => route("bo.tools.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
