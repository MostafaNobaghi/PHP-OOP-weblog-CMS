<?php

class Comment extends db_object {
    protected static $db_table = 'comments';
    protected static $db_fields = array('id', 'post_id', 'author', 'body', 'date');
    public $id;
    public $post_id;
    public $author;
    public $body;
    public $date;









    public static function create_comment($post_id, $author = 'Guest', $body = ''){
        if(!empty($post_id) && !empty($author) && !empty($body)){
            $comment = new self;
            
            $comment->post_id = $post_id;
            $comment->author   = $author;
            $comment->body     = $body;
            $comment->date     = date("Y/m/d H:i:s");
            
            return $comment;
        }  else {
            return FALSE;
        }
    }
    
    
    
    
    
    
    
    public static function find_the_comments($post_id=0) {
        global $database;
        
        $sql = " SELECT * FROM ".static::$db_table;
        $sql.= " WHERE post_id = " .$database->escape_string($post_id);
        $sql.= " ORDER BY id ASC";
        
        return static::find_by_query($sql);
    }
    
    
    
    
    
    
    
    
    public static function find_all_comments() {
        $sql = " SELECT * FROM ".static::$db_table;
        $sql.= " ORDER BY post_id ASC";
        
        return static::find_by_query($sql);
    }


  
    
}////////////////////////////////////////////////////// ENDS OF USER CLASS




