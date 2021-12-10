<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class BlogController extends BaseController
{
	public function home(){
		$postModel = new PostModel();

		$posts = $postModel->select('POSTS.ID, POSTS.TITLE, POSTS.CONTENT, POSTS.DATE, USERS.USERNAME, USERS.PICTURE')
						   ->join('USERS', 'USERS.ID = POSTS.AUTHOR', 'left')
						   ->orderBy('POSTS.DATE DESC')
						   ->paginate(5);
		
		$pager = $postModel->pager;

		return view('Blog/home', ['posts' => $posts, 'pager' => $pager]);
	}

    public function about(){
		$members = [
			["name" => "Seow Chee Yong", "id" => 1181103090, 'picture' => 'default.jpg'],
			["name" => "Lee Wei Kang", "id" => 1181103179, 'picture' => 'default.jpg'],
			["name" => "Tan Zheng Yan", "id" => 1181103452, 'picture' => 'default.jpg'],
			["name" => "Chan Xian Yang", "id" => 1191302859, 'picture' => 'default.jpg'],
			["name" => "Choo Zheng Yi", "id" => 1171203610, 'picture' => 'default.jpg']
		];

        return view('Blog/about', ['members' => $members]);
    }

	public function postpage($postId){
		$postModel = new PostModel();
		$userModel = new UserModel();

		$post = $postModel->where('id', $postId)->first();

		if($post != NULL){
			$authorId = $post['AUTHOR'];
			$author = $userModel->where('id', $authorId)->first();
	
			return view('Blog/postpage', ['post' => $post, 'author' => $author]);
		}else{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}

	public function newPost(){
		helper('form');

		if(session()->get('currentUser') == NULL){
			return view('CustomError/401');
		}else{
			// post method
			if($_POST){
				$validation = $this->validate([
					'title' => [
						'rules' => 'required|min_length[5]',
						'errors' => [
							'required' => 'Title is required',
							'min_length' => 'Minimum length of title is 5 characters'
						]
					],
					'content' => [
						'rules' => 'required|min_length[5]',
						'errors' => [
							'required' => 'Content is required',
							'min_length' => 'Minimum length of content is 5 characters'
						]
					]
				]);

				// invalid input
				if(!$validation){
					return (view('Blog/newpost', ['validation' => $this->validator]));
				}else{
					$postModel = new PostModel();

					$time = new Time('now', 'Asia/Singapore');

					$data = [
						'title' => $_POST['title'],
						'content' => $_POST['content'],
						'date' => $time->toDateTimeString(),
						'author' => session()->get('currentUser')['ID']
					];

					$query = $postModel->insert($data);

					if($query){
						session()->setFlashData('success', 'You have successfully upload a post.');
					}else{
						session()->setFlashData('error', 'Something went wrong while uploading a post');
					}

					return redirect()->to(base_url('/'));
				}
			}


			// get method
			return view('Blog/newpost');
		}
	}

	public function edit($postId){
		helper('form');

		$postModel = new PostModel();

		$post = $postModel->where('id', $postId)->first();

		// login required
		if(session()->get('currentUser') == NULL){
			return view('CustomError/401');
		}

		if($post != NULL){
			$authorId = $post['AUTHOR'];

			if(session()->get('currentUser')['ID'] == $authorId){
				if($_POST){
					$validation = $this->validate([
						'title' => [
							'rules' => 'required|min_length[5]',
							'errors' => [
								'required' => 'Title is required',
								'min_length' => 'Minimum length of title is 5 characters'
							]
						],
						'content' => [
							'rules' => 'required|min_length[5]',
							'errors' => [
								'required' => 'Content is required',
								'min_length' => 'Minimum length of content is 5 characters'
							]
						]
					]);

					// invalid input
					if(!$validation){
						return view('Blog/editpost', ['validation' => $this->validator]);
					}else{   // valid input
						$data = [
							'title' => $_POST['title'],
							'content' => $_POST['content']
						];

						$query = $postModel->update($postId, $data);

						if($query){
							session()->setFlashData('success', 'You have successfully updated a post');
						}else{
							session()->setFlashData('error', 'Something went wrong while updating a post');
						}

						return redirect()->to(base_url('/'));
					}
				}

				// get method
				return view('Blog/editpost', ['post' => $post]);
			}else{
				return view('CustomError/403');
			}
		}else{
			return view('CustomError/404');
		}
	}

	public function delete($postId){
		$postModel = new PostModel();

		if($postModel->isExist($postId)){
			$query = $postModel->delete($postId);

			if($query){
				session()->setFlashData('success', 'You have successfully deleted a post');
			}else{
				session()->setFlashData('error', 'Something went wrong while deleting a post');
			}

			return redirect()->to(base_url('/'));
		}else{
			return view('CustomError/404');
		}
	}
}
