<?php

namespace App\Http\Requests\System;

use App\Http\Requests\Request;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class UpdateWorkflowRequest extends Request
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
        $basic = [

        ];
        if (request()->input("assigned") == 1) {
            $opt = [
                'status' => [
                    'required',
                ],
            ];
            if (request()->input("status") == 2) {
                $opt2 = [
                    'comments' => [
                        'required',
                    ],
                ];
            } else {
                $opt2 = [
                    'comments' => [
                        'nullable',
                    ],
                ];
            }
            $opt = array_merge($opt, $opt2);
            $basic = array_merge($basic, $opt);
        }
        return $basic;
    }
}