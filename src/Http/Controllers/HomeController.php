<?php

namespace Nextbyte\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cms\Client;

use Illuminate\Http\Request;
use Nextbyte\Cms\Repositories\Cms\ClientRepository;

class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('cms::index');

    }
}
