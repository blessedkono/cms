<?php

namespace nextbytetz\websitecms\Http\Controllers\System;

use App\Http\Requests\System\RegionRequest;
use App\Models\System\Country;
use App\Models\System\Region;
use App\Repositories\System\RegionRepository;
use App\Repositories\System\CountryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class RegionController extends Controller
{

    //
    protected $region;
    protected $country;

    public function __construct()
    {
        $this->region = new RegionRepository();
        $this->country = new CountryRepository();

        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['createRegion', 'storeRegion',  'editRegion', 'updateRegion', 'deleteRegion', 'deactivateRegion', 'activateRegion' ]]);
    }

    public function getRegionsForDataTable($country)
    {

        $regions = $this->region->getRegionsBycountryIdForDataTable($country)->orderBy('name');
        return DataTables::of($regions)
            ->addIndexColumn()
            ->addColumn('actions', function($regions) {
                return $regions->actions_button;
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function createRegion($country)
    {
        $country = $this->country->find($country);
        return view('admin/system/region/create_region')
            ->with('country',$country);
    }

    public function storeRegion(RegionRequest $request,Country $country)
    {
        $region = $this->region->store($request->all(),$country);
        return redirect()->route('country.profile',$country->code)->withFlashSuccess(__('alert.general.created'));
    }

    public function editRegion($region)
    {
        $region = $this->region->getRegionByCode($region);
        $country = $this->country->getCountryById($region->country_id);
        return view('admin/system/region/edit_region')
            ->with('region',$region)
            ->with('country',$country);

    }

    public function updateRegion(RegionRequest $request,Region $region)
    {
        $region = $this->region->update($request->all(),$region);

        $country = $this->country->getCountryById($region->country_id);

        return redirect()->route('country.profile',$country->code)->withFlashSuccess(__('alert.general.updated'));
//        return view('system.country.includes.edit_region')
//            ->with('region',$region)
//        ->with('country',$country);

    }


    public function deleteRegion(Region $region)
    {
        $this->region->delete($region);
        return redirect()->back()->withFlashSuccess(__('alert.general.deleted'));
    }


    public function deactivateRegion($code)
    {
        $region = $this->region->getRegionByCode($code);
        $region = $this->region->deactivateRegion($region);
        return redirect()->back()->withFlashSuccess(__('alert.general.deactivated'));
    }


    public function activateRegion($code)
    {
        $region = $this->region->getRegionByCode($code);
        $region = $this->region->activateRegion($region);
        return redirect()->back()->withFlashSuccess(__('alert.general.activated'));
    }

}
