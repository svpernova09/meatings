<?php namespace Meatings\Http\Requests;

use Meatings\Http\Requests\Request;
use \Auth;

class EditUserForm extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        // id from the route
        $userId = $this->route('users');
        // our logged in user
        $loggedInUser =  Auth::user();

        return $userId == $loggedInUser->id;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required',
		];
	}

}
