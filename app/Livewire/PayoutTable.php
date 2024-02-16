<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Payout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class PayoutTable extends DataTableComponent
{
    protected $model = Payout::class;

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
        $this->setPrimaryKey('id');
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
            Column::make("Code", "code")
                ->sortable(),
            Column::make("Account number", "account_number")
                ->hideIf(true)
                ->sortable(),
            Column::make("Account type", "account_type")
                ->hideIf(true)
                ->sortable(),
            Column::make("Status", "status")
            ->format(
                function($value, $row, Column $column) {
                    if ($row->status == "pending"){
                        return '<span class="badge badge-pill bg-warning">Pending</span>';
                    }
                    if ($row->status == "on-process"){
                        return '<span class="badge badge-pill bg-info">On-Process</span>';
                    }
                    if ($row->status == "success"){
                        return '<span class="badge badge-pill bg-success">Success</span>';
                    }
                    if ($row->status == "danger"){
                        return '<span class="badge badge-pill bg-danger">Danger</span>';
                    }
                }
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
                            'detail' => route("bo.payouts.show", Crypt::encryptString($row->id)),
                            'edit'   => route("bo.payouts.edit", Crypt::encryptString($row->id)),
                            'delete' => route("bo.payouts.destroy", Crypt::encryptString($row->id)),
                        ]
                    )
                )->html(),
        ];
    }
}
