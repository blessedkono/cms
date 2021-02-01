<?php

namespace App\Http\Controllers\System;

use App\Http\Requests\System\CreateCurrencyRequest;
use App\Repositories\System\CurrencyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CurrencyController extends Controller
{
    protected  $currency;


    public function __construct()
    {
        $this->currency = new CurrencyRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('system.currency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCurrencyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCurrencyRequest $request)
    {
        $currency = $this->currency->createCurrency($request->all());
        return redirect()->route('currency.view', $currency->id)->withFlashSuccess('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = $this->currency->find($id);
        return view('system.currency.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = $this->currency->find($id);
        return view('system.currency.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateCurrencyRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCurrencyRequest $request, $id)
    {
        $currency = $this->currency->find($id);
        $this->currency->updateCurrency($request->all(), $currency);
        return redirect()->route('currency.view', $currency->id)->withFlashSuccess('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }


    public function getAllCurrenciesDatatable()
    {
        $currencies = $this->currency->getAll();

        return DataTables::of($currencies)
            ->addIndexColumn()
            ->addColumn('action', function ($query){
                return $query->action_buttons;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
