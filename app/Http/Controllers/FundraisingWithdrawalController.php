<?php

namespace App\Http\Controllers;

use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FundraisingWithdrawal;
use App\Http\Requests\StoreFundraisingWithdrawalRequest;
use App\Http\Requests\UpdateFundraisingRequest;
use App\Http\Requests\UpdateFundraisingWithdrawalReuest;

class FundraisingWithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fundraising_withdrawals = FundraisingWithdrawal::orderByDesc('id')->get();
        return view('admin.fundraising_withdrawals.index', compact('fundraising_withdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFundraisingWithdrawalRequest $request, Fundraising $fundraising)
    {
        $hasRequestedWithdrawal = $fundraising->withdrawals()->exists();

        if($hasRequestedWithdrawal) {
            return redirect()->route('admin.fundraisings.show', $fundraising);
        }

        DB::transaction(function() use ($request, $fundraising) {
            $validated = $request->validated();

            $validated['fundraiser_id'] = Auth::user()->fundraiser->id;
            $validated['has_received'] = false; // apakah fundraiser sudah menerima transferan
            $validated['has_sent'] = false; //apakah transpferan sudah di kirim oleh admin utama
            $validated['amount_requested'] = $fundraising->totalReachedAmount();
            $validated['amount_received'] = 0;
            $validated['proof'] = 'proof/buktitransferanpalsu.png';

            $fundraising->withdrawals()->create($validated);
            
        });
        return redirect()->route('admin.my-withdrawals');
    }

    /**
     * Display the specified resource.
     */
    public function show(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        return view('admin.fundraising_withdrawals.show', compact('fundraisingWithdrawal'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFundraisingWithdrawalReuest $request, FundraisingWithdrawal $fundraisingWithdrawal)
    {
         DB::transaction(function () use ($request, $fundraisingWithdrawal)  {
            $validated = $request->validated();

            if($request->hasFile('proof')){
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }
            $validated['has_sent'] = 1;

            $fundraisingWithdrawal->update($validated);

        });
        return redirect()->route('admin.fundraising_withdrawals.show', $fundraisingWithdrawal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        //
    }
}