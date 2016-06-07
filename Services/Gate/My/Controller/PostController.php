<?php

namespace My\Controller;

use My\Services\Comment;
use My\Services\Post;

class PostController extends MainController {
    
    public function all()
    {
        $posts = Post::get('all');
        return $this->response->html('posts', $posts);
    }

    public function get()
    {
        $id = $this->request->getIntParam('id');
        $post = Post::get('find', [
            'id' => $id
        ]);
        $comments = Comment::get('find', [
            'post_id' => $id
        ]);
        return $this->response->html('post', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
    
    public function addPage()
    {
        return $this->response->html('post_add');
    }

    public function add()
    {
        $post = Post::post('post_add', $this->request->post);
        return $this->response->html('post_add_success', $post);
    }
}