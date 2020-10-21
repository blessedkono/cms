<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 2/6/19
 * Time: 1:39 PM
 */

namespace App\Http\View\Composers\Wftrack;

use App\Repositories\Workflow\WfTrackRepository;
use Illuminate\View\View;

class WfTrackComposer
{
    protected $wf_track;


    public function __construct()
    {
        $this->wf_track = new WfTrackRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menu', $this->wf_track);
    }
}
