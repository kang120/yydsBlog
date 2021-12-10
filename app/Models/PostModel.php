<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model{
    
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'date', 'author'];

    public function getPosts(){
        return $this->findAll();
    }

    public function getPostsWithAuthorName(){
        /*
        $query = $this->db->query('SELECT POSTS.ID, POSTS.TITLE, POSTS.CONTENT, POSTS.DATE, USERS.USERNAME, USERS.PICTURE
                                   FROM POSTS JOIN USERS WHERE USERS.ID = POSTS.AUTHOR ORDER BY POSTS.DATE');
        */
        
        $query = $this->db->table('posts')->select('POSTS.ID, POSTS.TITLE, POSTS.CONTENT, POSTS.DATE, USERS.USERNAME, USERS.PICTURE')
                                          ->join('USERS', 'USERS.ID = POSTS.AUTHOR', 'left')
                                          ->orderBy('POSTS.DATE');
    }

    public function isExist($postId){
        $query = $this->db->query('SELECT * FROM POSTS WHERE ID=' . $postId);

        if($query->getNumRows() == 0){
            echo "gg /n";
            return false;
        }else{
            return true;
        }
    }
}