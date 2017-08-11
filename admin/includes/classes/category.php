<?php

class Category extends Db_object {
    
    protected static $db_fields = array('id', 'category_title');
    protected static $db_table = 'categories';
    public $id;
    public $category_title;
    
    
    
    
    
    
    
    
    public function extract_posts() {
        global $database;
        $category_id = $this->id;
        $posts = array();
        
        $sql = "SELECT  posts.id FROM posts
                JOIN junk
                ON  junk.post_id = posts.id
                WHERE ". $this->id ." = junk.category_id"   ;
        
        
        /*  WHERE junk.category_id   = '".$this->id."'"; */
        $result = $database->query($sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $id = array_shift($row);
            $post = Post::find_by_id($id);
            $posts[] = $post;
        }

        return $posts;  
    }
    
    
    
    
    
    public function count_post_in_category() {
        global $database;
        $category_id = $this->id;
        $sql = $sql = "SELECT COUNT(*)FROM junk
                WHERE category_id = {$category_id}";
                
        $result = $database->query($sql);
        $result = mysqli_fetch_array($result);
        return array_shift($result);
    }
    
    
    
    
    
    
    public function delete_category() {
        global $database;
        if($this->delete()){
            Junk::delete_junk('category_id', $this->id);
            return TRUE;
        }
    }
}



