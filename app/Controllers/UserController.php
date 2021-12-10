<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;

class UserController extends BaseController
{
	public function register(){
		helper('form', 'url');
		
		// POST request
		if($_POST){
			$validation = $this->validate([
				'username' => [
					'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric_punct|is_unique[users.username]',
					'errors' => [
						'required' => 'Username is required',
						'min_length' => "Username's length must between 6-20 characters",
						'max_length' => "Username's length must between 6-20 characters",
						'alpha_numeric_punct' => "Username cannot contains spaces",
						'is_unique' => "Username already exists"
					]
				],
				'email' => [
					'rules' => 'required|valid_email|is_unique[users.email]',
					'errors' => [
						'required' => 'Email is required',
						'valid_email' => 'Email is invalid',
						'is_unique' => "Email already exists"
					]
				],
				'password' => [
					'rules' => 'required|min_length[4]|max_length[20]|alpha_numeric_punct',
					'errors' => [
						'required' => 'Password is required',
						'min_length' => "Password's length must between 4-20 characters",
						'max_length' => "Password's length must between 4-20 characters",
						'alpha_numeric_punct' => "Password cannot contains spaces"
					]
				],
				'password2' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Confirmed password is required',
						'matches' => 'Passwords are not same'
					]
				]
			]);

			if(!$validation){
				// invalid input
				return view('User/register', ['validation' => $this->validator]);
			}else{
				// add user into database

				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$data = [
					'username' => $username,
					'password' => $password,
					'email' => $email
				];

				$userModel = new UserModel();
				$query = $userModel->insert($data);

				if($query){
					return redirect()->to('/')->with('success', 'Account ' . $username . ' has been successfully created.');
				}else{
					return redirect()->to('/')->with('error', 'Something went wrong.');
				}
				
				return redirect()->to('/');
			}
		}

		// GET request
		return view('User/register');
	}

	public function login(){
		helper('form');

		if($_POST){
			$validation = $this->validate([
				'username' => [
					'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric_punct|is_not_unique[users.username]',
					'errors' => [
						'required' => 'Username is required',
						'min_length[6]' => "Username's length must between 6-20 characters",
						'max_length[20]' => "Username's length must between 6-20 characters",
						'alpha_numeric_punct' => "Username cannot contains spaces",
						'is_not_unique' => "Username does not exists"
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
				]
			]);

			if(!$validation){
				// invalid input
				return view('User/login', ['validation' => $this->validator]);
			}else{
				// check password

				$userModel = new UserModel();

				$username = $_POST['username'];
				$password = $_POST['password'];
				$user = $userModel->where('username', $username)->first();
				$db_password = $user['PASSWORD'];
				
				// incorrect password
				if($password != $db_password){
					return view('User/login', ['password_error' => 'Incorrect password']);
				}else{
					session()->set("currentUser", $user);

					return redirect()->to('/')->with('success', 'You have log in successfully');
				}
			}
		}

		return view('User/login');
	}

	public function logout(){
		helper("session");

		session()->remove("currentUser");

		return view('User/logout');
	}

	public function profile($username){
		// login required
		if(session()->get('currentUser') == NULL){
			return view('CustomError/403');
		}

		helper('form', 'url');

		$userModel = new UserModel();
		$postModel = new PostModel();

		$user = $userModel->where('username', $username)->first();

		if($user == NULL){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$posts = $postModel->where('author', $user['ID'])->findAll();

		if($_POST){
			$validation = $this->validate([
				'username' => [
					'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric_punct|is_unique[users.username,users.username,' . $username . ']',
					'errors' => [
						'required' => 'Username is required',
						'min_length[6]' => "Username's length must between 6-20 characters",
						'max_length[20]' => "Username's length must between 6-20 characters",
						'alpha_numeric_punct' => "Username cannot contains spaces",
						'is_unique' => "Username already exists"
					]
				]
			]);

			// invalid input
			if(!$validation){
				return view('User/profile', ['user' => $user, 'posts' => $posts, 'validation' => $this->validator]);
			}else{   // valid input
				$newUsername = $_POST['username'];

				$data = [
					'username' => $newUsername
				];

				if(is_uploaded_file($_FILES['picture']['tmp_name'])){
					$img = $this->request->getFile('picture');

					$filename = $img->getRandomName();

					$this->request->getFile('picture')->move("profilepicture/", $filename);

					$data['picture'] = $filename;
				}
				
				$userId = $user['ID'];				
				$query = $userModel->update($userId, $data);

				if($query){
					// new user's information
					$user = $userModel->where('username', $newUsername)->first();

					session()->set("currentUser", $user);
					session()->setFlashData('success', "You have updated profile");

					return redirect()->to(base_url('profile/' . $newUsername));
				}else{
					session()->setFlashData('error', "Something went wrong");
				}
			}
		}

		// get method
		return view('User/profile', ['user' => $user, 'posts' => $posts]);
	}

	public function forgotPassword(){
		helper('text');

		if($_POST){
			$validation = $this->validate([
				'email' => [
					'rules' => 'required|valid_email|is_not_unique[users.email]',
					'errors' => [
						'required' => 'Email is required',
						'valid_email' => 'Email is invalid',
						'is_not_unique' => "User does not exist"
					]
				],
			]);

			// invalid input
			if(!$validation){
				return view('User/forgotpassword', ['validation' => $this->validator]);
			}else{   // valid input
				$email = \Config\Services::email();

				$token = random_string('md5', 32);   // generate random token

				session()->setTempData('resetToken', [$_POST['email'], $token], 900);   // set token valid within 15 mins

				$to = $_POST['email'];
				$subject = 'YYDS reset password';
				$message = 'The link below is your password reset link, the link is invalid after 15 minutes.<br>' .
							'Please reset your password immediately.<br>' .
							base_url('/reset/password/') . '/' . $token;

				$email->setTo($to);
				$email->setFrom("1181103179@student.mmu.edu.my", "YYDS");
				$email->setSubject($subject);
				$email->setMessage($message);

				if($email->send()){
					session()->setFlashData('success', 'Reset password link has been sent to your email, please check it immediately');
				}else{
					session()->setFlashData('error', 'Something went wrong while sending email');
					echo $email->printDebugger(['header']) . "<br>";
				}
			}
		}

		return view('User/forgotpassword');
	}

	public function resetPassword($token){
		$systemToken = session()->getTempData('resetToken');

		if($systemToken != NULL && $systemToken[1] == $token){
			$userModel = new UserModel();

			$email = session()->getTempData('resetToken')[0];
			$user = $userModel->where('email', $email)->first();

			if($_POST){
				$validation = $this->validate([
					'password' => [
						'rules' => 'required|min_length[4]|max_length[20]|alpha_numeric_punct',
						'errors' => [
							'required' => 'Password is required',
							'min_length' => "Password's length must between 4-20 characters",
							'max_length' => "Password's length must between 4-20 characters",
							'alpha_numeric_punct' => "Password cannot contains spaces"
						]
					],
					'password2' => [
						'rules' => 'required|matches[password]',
						'errors' => [
							'required' => 'Confirmed password is required',
							'matches' => 'Passwords are not same'
						]
					]
				]);

				// invalid input
				if(!$validation){
					return view('User/resetpassword', ['user' => $user, 'validation' => $this->validator]);
				}else{   // valid input
					$data = [
						'password' => $_POST['password']
					];

					$query = $userModel->update($user['ID'], $data);

					if($query){
						session()->setFlashData('success', 'You have successfully reset password');
					}else{
						session()->setFlashData('error', 'Something went wrong while reseting password');
					}

					session()->removeTempData('resetToken');

					return redirect()->to(base_url('login'));
				}
			}

			return view('User/resetpassword', ['user' => $user]);
		}else{
			return view('CustomError/404');
		}
	}
}