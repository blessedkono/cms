<?php


if (!function_exists('get_uri')) {
    /**
     * Determine the requested url path name
     *
     * @return string
     */
    function get_uri() {
        return urldecode(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
        );
    }
}

if (!function_exists('test_uri')) {
    function test_uri() {
        $uri = get_uri();
        //return (substr($uri, 0, 7) === '/public' Or strtolower(substr($_SERVER['SERVER_SOFTWARE'], 0, 5)) == 'nginx');
        return (strpos($uri, 'public') Or strtolower(substr($_SERVER['SERVER_SOFTWARE'], 0, 5)) == 'nginx');
    }
}


if (!function_exists('asset_url')) {

    /**
     * Return the assets folder url of this application
     *
     * @return string
     */
    function asset_url() {
        if (test_uri()) {
            return url("/") . '/assets';
        } else {
            return url("/") . '/public/assets';
        }
    }

}

if (!function_exists('public_url')) {

    /**
     * Return the public url of the application
     *
     * @return type string
     */
    function public_url() {
        return url("/");
    }

}

if (! function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


if (!function_exists('getFallbackLocale')) {

    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function getFallbackLocale() {
        return config('app.fallback_locale');
    }

}

if (!function_exists('getLanguageBlock')) {

    /**
     * Get the language block with a fallback
     *
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getLanguageBlock($view, $data = []) {
        $components = explode("lang", $view);
        $current = $components[0] . "lang." . app()->getLocale() . "." . $components[1];
        $fallback = $components[0] . "lang." . getFallbackLocale() . "." . $components[1];

        if (view()->exists($current)) {
            return view($current, $data);
        } else {
            return view($fallback, $data);
        }
    }

}


if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('sysdef')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function sysdef()
    {
        return app('sysdef');
    }
}

if (! function_exists('code_value')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function code_value()
    {
        return app('code_value');
    }
}


if (! function_exists('sec_env')) {
    function sec_env($name, $fallback = '') {
        $env = require __DIR__. './../../config/env.php';
        $crypt  = new \Illuminate\Encryption\Encrypter($env["key"]);
        if (isset($_SERVER[$name])) {
            $password = $crypt->decrypt($_SERVER[$name]);
        } else {
            $password = $fallback;
        }
        return $password;
    }
}


/*
 * truncate to n characters of string
 */
if(! function_exists('truncateString')) {
    function truncateString($string, $stringLimit = 300){
        return str_limit($string, $stringLimit, $end = "...");
    }
}

/*
 * Generate random string with n number of characters, 3 is default, for reference [code_values]
 */
if(! function_exists('randomString')) {
    function randomString($chars = 3) {
        return strtoupper(str_random($chars));
    }
}


/* Number format with 2 decimal places with thousands separator 10,000.00*/

if (! function_exists('number_2_format')) {
    function number_2_format($value)
    {
        return  number_format( $value , 2, '.' , ',' );
    }
}


/* Number format with no decimal places with thousands separator 10,000 */

if (! function_exists('number_0_format')) {
    function number_0_format($value)
    {
        return  number_format( $value , 0, '.' , ',' );
    }
}

/*short date format D-M-Y*/
if (! function_exists('short_date_format')) {
    function short_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('d-M-Y');
        }else{
            return null;
        }

    }
}

/*short date format D-M-Y*/
if (! function_exists('short_date_format_with_day')) {
    function short_date_format_with_day($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('d-M-Y l');
        }else{
            return null;
        }

    }
}



/*Standard format date format Y-m-j for storing in the database*/
if (! function_exists('standard_date_format')) {
    function standard_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('Y-n-j');
        }else{
            return null;
        }
    }
}

if (! function_exists('timestamp_format')) {
    function timestamp_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('Y-n-j H:i:s');
        }else{
            return null;
        }
    }
}

if (! function_exists('carbon_parse')) {
    function carbon_parse($date)
    {
        return \Carbon\Carbon::parse($date);
    }
}


/*comparable date format D-M-Y*/
if (! function_exists('comparable_date_format')) {
    function comparable_date_format($date)
    {
        $standard_format = standard_date_format($date);
        return strtotime($standard_format);
    }
}

if (!function_exists('max_document_size')) {
    function max_document_size() {
        return  sysdef()->data('MAXDCS');//MB
    }
}

/*Mb to kb*/
if (!function_exists('mb_to_kb')) {
    function mb_to_kb() {
        return  1024;
    }
}

/*General maximum file size upload i.e. max_size in MB*/
if (!function_exists('max_file_size_upload_kb')) {
    function max_file_size_upload_kb($max_size = 3) {
        return  mb_to_kb() * $max_size;
    }
}


/*Today's date*/
if (! function_exists('getTodayDate')) {

    function getTodayDate()
    {
        return \Carbon\Carbon::now()->format('Y-n-j');

    }
}

/*System Launch date*/
if (! function_exists('getLaunchDate')) {
    function getLaunchDate()
    {
        $launch_date = '2020-01-01';
        return \Carbon\Carbon::parse($launch_date)->format('Y-n-j');
    }
}


/*When timesheet started*/
if (! function_exists('getTimesheetStartDate')) {
    function getTimesheetStartDate()
    {
        $start_date = '2020-18-06';
        return \Carbon\Carbon::parse($start_date)->format('Y-n-j');
    }
}


/*convert int to date format long*/
if (! function_exists('convert_int_to_datetime')) {
    function convert_int_to_datetime($timestamp)
    {
        return idate('j', $timestamp) . '-' . idate('m', $timestamp) . '-' . idate('Y', $timestamp) . ' ' . idate('H', $timestamp) . ':' . idate('i', $timestamp) . ':' . idate('s', $timestamp);
    }
}


/*add - after 3 characters, for TIN*/
if (! function_exists('chunk_hyphen')) {
    function chunk_hyphen($string){
        return implode("-", str_split($string, 3));
    }
}

/*capture the first word after dot (.)*/
if (! function_exists('capture_first')) {
    function capture_first($string){
        $arr = explode(".", $string, 2);
        return $first = $arr[0];
    }
}


if (! function_exists('phone_255')) {
    function phone_255($phone)
    {
        return \Propaganistas\LaravelPhone\PhoneNumber::make($phone, 'TZ')->formatE164();
    }
}

if (! function_exists('phone_make')) {
    function phone_make($phone, $country_code)
    {
        return \Propaganistas\LaravelPhone\PhoneNumber::make($phone, $country_code)->formatE164();
    }
}


function renderVariable($text) {
    return preg_replace_callback('/@\(\"([^"]+)\"\)/', function($matches) {
        return $matches[1];
    }, $text);
}

function renderDescription($text) {
    //Evaluate all trans functions as PHP
    //We don't want to use eval() for security reasons so we're explicitly converting trans cases
    return preg_replace_callback('/trans\(\"([^"]+)\"\)/', function($matches) {
        return trans($matches[1]);
    }, $text);
}

/**
 * Exception $e
 */
if (! function_exists('log_error')) {
    function log_error(Exception $e)
    {
        \Illuminate\Support\Facades\Log::error('[' . $e->getCode() . '] ' . $e->getMessage() . ' on line ' . @$e->getTrace()[0]['line'] . ' of file ' . @$e->getTrace()[0]['file']);
    }
}



if (! function_exists('unix_to_excel_date')) {
    function unix_to_excel_date($unix_date)
    {
        $excel_date = 25569 + ($unix_date / 86400);
        return $excel_date;
    }
}




if (! function_exists('remove_thousands_separator')) {
    function remove_thousands_separator($value)
    {
        $value = str_replace(",", "",   $value);
        return $value;

    }
}

if (! function_exists("single_space")) {
    function single_space($input) {
        $input = preg_replace('!\s+!', ' ', trim($input));
        return $input;
    }
}




if (! function_exists("remove_extra_white_spaces")) {
    function remove_extra_white_spaces($value) {
        $value =  preg_replace('/\s+/', ' ', $value );
        return $value;
    }
}

/*Remove last this char*/
if (!function_exists('remove_last_this_char')) {
    function remove_last_this_char($string, $char) {
        $last_char = substr($string, -1, 1);
        if($last_char == $char){
            $string = substr($string, 0, -1);
        }
        return $string;
    }
}

/*Remove first this char*/
if (!function_exists('remove_first_this_char')) {
    function remove_first_this_char($string, $char) {
        $first_char = substr($string, 0, 1);
        if($first_char == $char){
            $string = substr($string, 1);
        }
        return $string;
    }
}

if (!function_exists('proper_case_word')) {
    function proper_case_word($string) {
        $string = strtolower(remove_extra_white_spaces($string));
        return  ucwords($string);
    }
}



if (! function_exists('checksum')) {
    /**
     * @author Mathayo Mihayo
     * upgraded by Erick Chrysostom (To restrict the checksum repeated sequence)
     * Add a checksum and padding for a given ID
     * @param $id
     * @param $pad_length
     * @return string
     */
    function checksum($id, $pad_length)
    {
        $number = $id;
        $list = "542316798";
        $sum = 0;
        do {
            $sum += $number % 10;
        }
        while ($number = (int) $number / 10);
        $check = $sum % 10;
        $check = $check + 3;
        $check = $check % 10;
        if($check == 0)
        {
            //$check = 1;
        }
        if ($id % 2 == 0) {
            /* It is even */
            if($check == 0)
            {
                $check = 7;
            }
            $check = substr($list, $check - 1, 1);
        } else {
            /* It is odd */
            if($check == 0)
            {
                $check = -2;
            }
            $check = substr($list, $check * -1, 1);
        }
        $padding = str_pad($id, $pad_length, '00', STR_PAD_LEFT);
        return $check.$padding;
    }
}




if (! function_exists('months_diff')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function months_diff($from_date, $end_date)
    {
        /*end parts*/
        $end_day = \Carbon\Carbon::parse($end_date)->format('d');
        $end_month = \Carbon\Carbon::parse($end_date)->format('m');
        $end_year = \Carbon\Carbon::parse($end_date)->format('Y');
        /*from parts*/
        $from_day = \Carbon\Carbon::parse($from_date)->format('d');
        $from_month = \Carbon\Carbon::parse($from_date)->format('m');
        $from_year = \Carbon\Carbon::parse($from_date)->format('Y');

        $diff_months = 0;
        if ($end_year == $from_year ){
            $diff_months = $end_month - $from_month;
        };

        if ($end_year <> $from_year ){
            $diff_year = $end_year - $from_year;
            $get_months = $diff_year * 12;
            $end_month  = $end_month + $get_months;
            $diff_months = $end_month - $from_month;
        };
        return $diff_months;

    }

}



if (!function_exists('explode_parameter')) {
    /**
     * Return an array of the inputs string parameter
     * separated by commas e.g 1,2,3,4
     *
     * @param $parameter
     * @return array
     */
    function explode_parameter($parameter) {
        if (! isset($parameter)) {
            $output = [];
        } else {
            $output = explode(",", $parameter);
        }
        return $output;
    }

}


if (!function_exists('implode_collection_name')) {
    /**
     * Return an strings separated by commas
     * separated by commas e.g Dsm, Morogoro, Arusha
     *
     * @param $parameter
     * @return array
     */
    function implode_collection_name($collection, $custom_col_name = 'name') {
        $output = [];
        foreach ($collection as $parameter) {
            array_push($output, $parameter->$custom_col_name);
        }
        return implode(", ", $output);
    }

}


/*Base doc directory used for attaching document*/
if (!function_exists('base_doc_dir')) {

    function base_doc_dir() {
        return public_path() . '/storage';
    }

}

/*Base doc path for review attached file*/
if (!function_exists('base_doc_path')) {

    function base_doc_path() {
        /**
         *
         */
        if (test_uri()) {
            return asset('/storage');
        } else {
            return asset('/public/storage');
        }
    }

}

//task attachment dir
if (!function_exists('task_dir')) {
    function task_dir() {
        return public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'task';
    }
}


//   url for task documents files
if (!function_exists('task_url')) {
    function task_url() {
        return 'storage' . DIRECTORY_SEPARATOR . 'task';
    }
}

if (!function_exists('document_resource_dir')) {
    function document_resource_dir() {
        return public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'document_resource';
    }
}

/*Set Side Bar Active link*/
if (!function_exists('setSideBarActive')) {
    function setSideBarActive($path)
    {
        return Request::is($path . '*') ? ' class=nav-expanded nav-active' :  '';
    }
}


if (!function_exists('document_url')){
    function documentUrl($doc_id){
        return (new \App\Repositories\System\DocumentResourceRepository())->getDocFullPathUrl($doc_id);

    }
}


/*Small helper to put description or instruction on form inputs*/
if (!function_exists('small_helper')) {
    function small_helper($helper)
    {
        return '<small style="color:grey;">' . $helper . '</small>';
    }
}

if (! function_exists('short_name_month_from_int')) {
    function short_name_month_from_int()
    {
        return [
            '1' => 'Jan',
            '01' => 'Jan',
            '2' => 'Feb',
            '02' => 'Feb',
            '3' => 'Mar',
            '03' => 'Mar',
            '4' => 'Apr',
            '04' => 'Apr',
            '5' => 'May',
            '05' => 'May',
            '6' => 'Jun',
            '06' => 'Jun',
            '7' => 'Jul',
            '07' => 'Jul',
            '8' => 'Aug',
            '08' => 'Aug',
            '9' => 'Sep',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        ];
    }
}




if (!function_exists('setSideBarActiveUrl')) {
    function setSideBarActiveUrl($path, $class = ' nav-expanded nav-active')
    {
        return (url($path) == URL::current()) ? $class :  '';
    }
}


if (!function_exists('setSideBarActiveUrlByPar')) {
    function setSideBarActiveUrlByPar(array $parameter, $class)
    {
        $return = true;

        foreach ($parameter as $key => $par){
            $check = false;
            if(isset($_GET[$key])){
                $check = ($_GET[$key] == $par) ? true : false;
            }

            if($check == false){
                $return = false;
            }
        }

        return ($return == true) ? $class :  '';
    }
}


if (!function_exists('setSideBarActiveStrPosUrl')) {
    function setSideBarActiveStrPosUrl($path, $class)
    {
        $current_url =   URL::current();
//        \Illuminate\Support\Facades\Log::info(print_r(67,true));
        if(strpos($current_url, $path) !== false){
            return $class;
        }


    }
}

/*Convert rating into percentage*/
if (!function_exists('convert_rating_to_percentage')) {
    function convert_rating_to_percentage($rating, $rating_scale = 5)
    {
        $percentage = ($rating/$rating_scale) * 100;
        return $percentage;
    }
}

/*Cap value to maximum*/
if (!function_exists('limit_to_max_value')) {
    function limit_to_max_value($value, $maximum_scale = 5)
    {
        return ($value > $maximum_scale) ? $maximum_scale : $value;
    }
}

/*Task rating scale*/
if (!function_exists('task_rating_scale')) {
    function task_rating_scale()
    {
        return 5;
    }
}

if (!function_exists('diff_for_humans_dates')) {
    function diff_for_humans_dates($first_date, $second_date)
    {
        return \Carbon\Carbon::parse($first_date)->diffForHumans(\Carbon\Carbon::parse($second_date));
    }
}

/*Allow to edit object */
if (!function_exists('allow_to_edit_object')) {
    function allow_to_edit_object($created_at)
    {
        $created_at_parsed = \Carbon\Carbon::parse($created_at);
        $max_days = sysdef()->data('THSHMXDEDI');
        $today = getTodayDate();
        $last_date_to_edit = $created_at_parsed->addDays($max_days);
        if(comparable_date_format($last_date_to_edit) >= comparable_date_format($today)){
            return true;
        }else{
            return false;
        }
    }
}


/*No of weeks to diplay approved task on timesheet*/
if (!function_exists('weeks_task_allowed_timesheet')) {
    function weeks_task_allowed_timesheet()
    {
        return 2;
    }

}

if (!function_exists('system_logo_base64')) {
    function system_logo_base64()
    {
        return (new \App\Repositories\System\SysdefRepository())->getBase64Logo();
    }
}

if (!function_exists('division_thousands')) {
    function division_thousands($max_value)
    {
        if($max_value >= 0 && $max_value <1000000){
            return ['division' => 1000, 'label' => '000'];
        }elseif($max_value >= 1000000 && $max_value < 1000000000){
            return ['division' => 1000000, 'label' => '000,000'];
        }else{
            return ['division' => 1000000000, 'label' => '000,000,000'];
        }
    }
}


if (!function_exists('display_two_letters')) {
    function display_two_letters($text){
        $str = $text;
        $pos = strpos($str, " ");
        $result = $str[0] . $str[$pos + 1];

        return $result;
    }
}
