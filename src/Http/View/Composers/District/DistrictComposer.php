<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 2/6/19
 * Time: 1:39 PM
 */

namespace App\Http\View\Composers\District;

use App\Repositories\System\DistrictRepository;
use Illuminate\View\View;

class DistrictComposer
{
    protected $districts;


    public function __construct()
    {
        $this->districts = new DistrictRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('districts', $this->districts);
    }
}
