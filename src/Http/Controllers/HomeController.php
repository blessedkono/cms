<?php

namespace App\Http\Controllers;

use App\Models\Cms\Client;
use App\Repositories\Cms\ClientRepository;
use App\Repositories\Information\ForumRepository;
use App\Repositories\Information\NewsRepository;
use Illuminate\Http\Request;

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
        $clients = (new ClientRepository())->queryActive()->get();
        $clients_with_testimonial =Client::whereHas('testimonial',function (){
        })->get();
        return view('home')
            ->with('clients',$clients)
            ->with('clients_with_testimonial',$clients_with_testimonial);
    }
}
