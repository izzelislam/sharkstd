<?php

namespace App\Livewire;

use App\Helpers\UploadFile;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

class BlogTable extends DataTableComponent
{
    protected $model = Blog::class;

    public function builder(): Builder
    {
        $model = new $this->model();
        $query = $model->query();
        if (auth()->guard("admin")->user()->role !== "administrator"){
            $query->where("admin_id", auth()->guard("admin")->user()->id);
        }
        return  $query;
    }

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
        $images     = $model->whereIn("id", $datas)->pluck("cover_image");
        UploadFile::files_delete($images->toArray());
        $model->destroy($datas);
    }

    public $columnSearch = [
        'title' => null,
    ];

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
                    ->whereDate('blogs.updated_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('blogs.updated_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
            DateRangeFilter::make('created_at')
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('blogs.created_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('blogs.created_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true)
                ->sortable(),
            Column::make("Admin id", "admin_id")
                ->sortable(),
            Column::make("Blog category id", "blogCategory.name")
                ->sortable(),
            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            Column::make("Slug", "slug")
                ->hideIf(true)
                ->sortable(),
            Column::make("Content", "content")
                ->hideIf(true)
                ->sortable(),
            Column::make("Image cover", "image_cover")
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
                            'detail' => route("bo.blogs.show", $row->slug),
                            'edit'   => route("bo.blogs.edit", $row->slug),
                            'delete' => route("bo.blogs.destroy", $row->slug),
                        ]
                    )
                )->html(),
        ];
    }
}
