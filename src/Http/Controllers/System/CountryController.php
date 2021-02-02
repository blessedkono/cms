<?php

namespace nextbytetz\websitecms\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\CountryRequest;
use App\Models\System\Country;
use App\Repositories\System\CountryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{

    protected $countries;
    public  function __construct()
    {

        $this->countries = new CountryRepository();
        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['createCountry', 'storeCountry',  'profile', 'editCountry', 'updateCountry', 'deleteCountry', 'deactivateCountry','activateCountry' ]]);
    }



    public function index()
    {
        return view('admin/system/country/index');
    }
    //


    public function createCountry()
    {
        return view('admin/system/country/create');
    }


    public function storeCountry(CountryRequest $request)
    {
        $country  = $this->countries->store($request->all());
        return redirect()->route('country.profile',$country->code);
    }
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function getCountriesForAdminDatatable()
    {

        $countries = $this->countries->getCountriesForDataTable();
//        dd($countries);
        return DataTables::of($countries)
            ->addIndexColumn()

            ->addColumn('actions', function($countries) {
                return $countries->actions_button;
            })
            ->rawColumns(['actions'])
            ->make(true);


    }

    public function profile($code)
    {
        $country = $this->countries->getCountryByCode($code);
        return view('admin/system/country/profile')
            ->with('country',$country);
    }

    public function editCountry($code)
    {
        $country = $this->countries->getCountryByCode($code);
        return view('admin/system/country/edit')
            ->with('country',$country);
    }

    public function updateCountry(CountryRequest $request,Country $country)
    {
        $country = $this->countries->update($request->all(),$country);
        return redirect()->route('country.profile',$country->code)->withFlashSuccess(__('alert.general.updated'));

    }

    public function deleteCountry($code)
    {
        $country = $this->countries->getCountryByCode($code);
        $this->countries->delete($country);
        return redirect()->back()->withFlashSuccess(__('alert.general.deleted'));

    }

    public function deactivateCountry($code)
    {
        $country = $this->countries->getCountryByCode($code);
        $country = $this->countries->deactivateCountry($country);
        return redirect()->back()->withFlashSuccess(__('alert.general.deactivated'));


    }

    public function activateCountry($code)
    {
        $country = $this->countries->getCountryByCode($code);
        $country = $this->countries->activateCountry($country);
        return redirect()->back()->withFlashSuccess(__('alert.general.activated'));
    }

}
