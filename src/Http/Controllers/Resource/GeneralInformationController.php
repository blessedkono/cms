<?php


namespace nextbytetz\websitecms\Http\Controllers\Resource;


use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\SendContactUsRequest;
use App\Models\Cms\Module;
use App\Models\Cms\ModuleGroup;
use App\Repositories\Cms\ContactUsRepository;
use App\Repositories\Cms\ModuleGroupRepository;
use App\Repositories\System\SubscriptionRepository;
use Illuminate\Http\Request;

class GeneralInformationController extends Controller
{

    public function __construct()
    {

    }

    //about us
    public function aboutUs()
    {
        return view('system.general_information.about_us');
    }

    //contact us
    public function contactUs()
    {
        return view('system.general_information.contact_us');
    }

    //pricing
    public function pricing()
    {
        return view('system.general_information.pricing');
    }

    //send  contact us
    public function sendMessageToSupportEmail(SendContactUsRequest $request)
    {
        $contact_us = (new ContactUsRepository())->sendContactUsNotification($request);
        return redirect()->back()->withFlashSuccess(trans('label.system.general_information.success'));
    }


    //newsletter subscription
    public function newsLetterSubscription(Request $request)
    {
        $subscriber = (new SubscriptionRepository())->store($request->all());
        return redirect()->back();
    }

    //user manual
    public function userManual()
    {
        $modules = Module::query()->get();
        $module_groups = (new ModuleGroupRepository())->queryActive()->orderBy('name')->get();
        return view('cms.user_manual.index')
            ->with('module_groups',$module_groups)
            ->with('modules',$modules);
    }


}
