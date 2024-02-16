<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

class WalletTable extends DataTableComponent
{
    protected $model = Wallet::class;

    public function builder(): Builder
    {
        $model = new $this->model();
        $query = $model->query();
        if (auth()->guard("admin")->user()->role !== "administrator"){
            $query->where("admin_id", auth()->guard("admin")->user()->id);
        }
        return  $query;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')->setFilterLayoutSlideDown();
    }

    public function filters(): array
    {
        return [
            DateRangeFilter::make('updated_at')
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('wallets.updated_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('wallets.updated_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
            }),
            DateRangeFilter::make('created_at')
            ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
                $builder
                    ->whereDate('wallets.created_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                    ->whereDate('wallets.created_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
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
                ->hideIf(true)
                ->sortable(),
            Column::make("User Name", "admin.name")
                ->sortable(),
            Column::make("Email", "admin.email")
                ->sortable(),
            Column::make("Amount", "amount")
                ->format(
                    fn($value, $row, Column $column) =>'<b>'. $row->amount.' USD </b>'
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
                            'detail' => route("bo.wallets.show", Crypt::encryptString($row->id)),
                        ]
                    )
                )->html(),
        ];
    }
}
