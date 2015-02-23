<?php namespace App\Http\Requests;

use Auth;

use Illuminate\Foundation\Http\FormRequest;

class InviteFormRequest extends FormRequest {

	public function rules() {
		// TODO: Can Laravel validate as array-of-emails?
		return [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
		];
	}

	public function authorize() {
		return Auth::check() && Auth::user()->can('edit_own_organisation');
	}
}