<?php

class Junk extends Db_object {
    protected static $db_table = 'junk';
    protected static $db_fields = array('id', 'category_id', 'post_id');
    public $id;
    public $post_id;
    public $category_id;




    static function set_categories($post_id, $category_id) {
        $junk = new self;
        $junk->post_id     = $post_id;
        $junk->category_id = $category_id;
        return $junk->save();
    }
    
    
    
    
    
    
    
    public static function delete_junk($column_id, $id) {
        global $database;
//        $category_id = $this->id;
        $sql = "DELETE FROM junk
                WHERE ".$column_id." = ".$id ;

        $database->query($sql);
        return (mysqli_affected_rows($database->connection)>=1)? TRUE : FALSE;
    }



}

