<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends Request
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
        $user_id = $input['user_id'];
        //TODO : Check phone according to the country
        return [
            'firstname' => 'required|string|max:191|min:3|alpha_spaces',
            'middlename' => 'nullable|string|max:191|min:2|alpha_spaces',
            'lastname' => 'required|string|max:191|min:2|alpha_spaces',
            'phone' => ['required','string','phone:TZ',
                Rule::unique('users')->where(function ($query) use($user_id)  {
                    $query->where('id','<>', $user_id);
                })
            ],

            'email' => ['required','string', 'email', 'max:255',
                Rule::unique('users')->where(function ($query) use($user_id)  {
                    $query->where('id','<>', $user_id);
                })
            ],
            'username' => 'required|string|max:191|min:2',
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
