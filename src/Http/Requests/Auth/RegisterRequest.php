<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
        return [
            'username' => 'required|string|max:191|min:2',
            'firstname' => 'required|string|max:191|min:3|alpha_spaces',
            'middlename' => 'nullable|string|max:191|min:2|alpha_spaces',
            'lastname' => 'required|string|max:191|min:2|alpha_spaces',
            'phone' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'captcha' => 'required|captcha',
            'term_check' => 'required',
        ];

        //return array_merge($check_identity,$basic);

    }

    /**
     * @return array
     */
    public function sanitize()
    {
        $input = $this->all();
            $input['email'] = strtolower(trim($input['email']));
        /*Remove extra whitespace*/
        $input['firstname']  =  preg_replace('/\s+/', ' ', $input['firstname'] );
        $input['middlename']  =  preg_replace('/\s+/', ' ', $input['middlename'] );
        $input['lastname']  =  preg_replace('/\s+/', ' ', $input['lastname'] );

        $this->replace($input);
        return $this->all();

    }

}
