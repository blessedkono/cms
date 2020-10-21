<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Propaganistas\LaravelPhone\PhoneNumber;

class RegisterSystemUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();
        $basic  = [];
        $optional = [];// Fields which exist
        $array = [];


        $basic = [
            'username' => 'required|string|max:191|unique:users',
            'firstname' => 'required|string|max:191|alpha_spaces',
            'middlename' => 'nullable|string|max:191|alpha_spaces',
            'lastname' => 'required|string|max:191|alpha_spaces',
            'phone' => 'required|unique:users|phone:TZ'  ,
            'email' => 'required|string|email|max:191|unique:users',
            'roles' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ];



        return array_merge( $basic, $optional);
    }

    /**
     * @return array
     */
    public function sanitize()
    {

        /*start exceptions on trim*/
        /*roles*/
        $roles = [];
        if(array_key_exists('roles', request()->input())){
            $roles = [ 'roles' => request()->input('roles')];
        }
        /*trim with exception*/
        $input = array_map('trim', $this->except( 'roles'));
        /*merge with exception*/
        $input= array_merge($roles,$input);
        /*end exception*/
        $input['email'] = strtolower(trim($input['email']));
        /*Remove extra whitespace*/
        $input['firstname']  = remove_extra_white_spaces($input['firstname'] );
        $input['middlename']  =  remove_extra_white_spaces($input['middlename']);
        $input['lastname']  =  remove_extra_white_spaces($input['lastname']);
//        $input['phone'] = PhoneNumber::make($input['phone'], $input['country'])->formatE164();
        $this->replace($input);
        return $this->all();

    }

}
