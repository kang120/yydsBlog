<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
		'register' => 'User/register'
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $register = [
		'username' => [
			'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric_punct',
			'errors' => [
				'required' => 'Username is required',
				'min_length[6]' => "Username's length must between 6-20 characters",
				'max_length[20]' => "Username's length must between 6-20 characters",
				'alpha_numeric_punct' => "Username cannot contains spaces"
			]
		],
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'Email is required',
				'valid_email' => 'Email is invalid'
			]
		],
		'password' => [
			'rules' => 'required|min_length[4]|max_length[20]|alpha_numeric_punct',
			'errors' => [
				'required' => 'Password is required',
				'min_length[4]' => "Password's length must between 4-20 characters",
				'max_length[20]' => "Password's length must between 4-20 characters",
				'alpha_numeric_punct' => "Password cannot contains spaces"
			]
		],
		'password2' => [
			'rules' => 'required|matches[password]',
			'errors' => [
				'required' => 'Confirmed password is required',
				'matches[password]' => 'Passwords are not same'
			]
		]
	];
}
