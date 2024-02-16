<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class CustomerTable extends DataTableComponent
{
    protected $model = User::class;

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
                    ->whereDate('users.updated_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('users.updated_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
            DateRangeFilter::make('created_at')
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('users.created_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('users.created_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true)
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Address", "address")
                ->hideIf(true)
                ->sortable(),
            BooleanColumn::make("Status", "status")
                ->sortable(),
            Column::make("Postal code", "postal_code")
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
                            'detail' => route("bo.customers.show", Crypt::encryptString($row->id)),
                            'edit'   => route("bo.customers.edit", Crypt::encryptString($row->id)),
                            'delete' => route("bo.customers.destroy", Crypt::encryptString($row->id)),
                        ]
                    )
                )->html()
        ];
    }
}
