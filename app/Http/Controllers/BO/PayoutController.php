<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Services\Payout\PayoutService;
use App\Services\Wallet\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PayoutController extends Controller
{
    protected $service;
    protected $walletService;
    protected $adminService;

    public function __construct(
        PayoutService $service, 
        WalletService $wallerService,
        AdminService $adminService,
    ){
        $this->service = $service;
        $this->walletService = $wallerService;
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["route"] = route("bo.payouts.create");
        return view("bo.payout.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["route"]      = route("bo.payouts.store");
        $data["users"]      = Utils::SelectFormatter($this->adminService->all());
        return view("bo.payout.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "amount"           => "required",
            "account_type"     => "required",
            "account_number"   => "required",
        ];

        $role = auth()->guard("admin")->user()->role;
        if ($role == "administrator"){
            $rules["admin_id"] = "required|exists:admins,id";
        }else {
            $request["admin_id"] = auth()->guard("admin")->user()->id;
        }

        $request->validate($rules);
        $request["status"]       = "pending";
        $request["code"]         = "WD-".Utils::CodeGenerator(12);

        $wallet = $this->adminService->find(Crypt::encryptString($request->admin_id))->wallet;
        if ($wallet->amount < $request->amount){
            return Utils::BackFail("Your amount greater than your saldo wallet");
        }
        
        try {
            $this->service->create($request->all());
            $walet_dada = [
                "admin_id" => $request->admin_id,
                "amount"   => $wallet->amount - $request->amount
            ];
            $this->walletService->update($wallet->id, $walet_dada);
            
            return Utils::RedirectSuccess(route("bo.payouts.index"), "Success create payout");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_enc)
    {
        $id     = Crypt::decryptString($id_enc);
        $data["model"] = $this->service->find($id);
        return view("bo.payout.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_enc)
    {
        $id     = Crypt::decryptString($id_enc);
        $data["model"] = $this->service->find($id);
        $data["users"]      = Utils::SelectFormatter($this->adminService->all());
        $data["route"] = route("bo.payouts.update", $id_enc);
        return view("bo.payout.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_enc)
    {
        $id     = Crypt::decryptString($id_enc);

        $rules = [
            "amount"           => "required",
            "account_type"     => "required",
            "account_number"   => "required",
        ];

        $request->validate($rules);

        $payout      = $this->service->find($id);
        $wallet_user = $this->adminService->find(Crypt::encryptString($payout->admin_id))->wallet;
        // dd($wallet_user);
        $wallet      = $this->walletService->find($wallet_user->id);

        $wallet->update(["amount" => $wallet->amount + $payout->amount]);

        if ($wallet->amount < $request->amount){
            return Utils::BackFail("Your amount greater than your saldo wallet");
        }

        try {
            $this->service->update($id, $request->all());
            $wallet->update(["amount" => $wallet->amount - $request->amount]);
            
            return Utils::RedirectSuccess(route("bo.payouts.index"), "Success update payout");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_enc)
    {
        try {
            $id     = Crypt::decryptString($id_enc);
            $model  = $this->service->find($id);
            $wallet = $this->walletService->find($model->admin->wallet->id);

            if (in_array($model->status, ["pending", "on-process"])){
                $wallet->update(["amount" => $wallet->amount + $model->amount ]);
            }

            $this->service->delete($id);
            return Utils::BackSuccess("Success delete payout");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }
}
