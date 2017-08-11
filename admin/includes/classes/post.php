<?php

class Post extends Db_object {
    protected static $db_table = 'posts';
//    protected static $file_property = '$this->item_image';
    protected static $db_fields = array('title', 'description', 'item_image', 'publisher', 'date' );
    public $id;
    public $title;
    public $description;
    public $image_directory = 'images/posts';
    public $item_image;
    public $publisher;
    public $date;
    
    
    
    
    
    // some function return $_file
    
    
    
    
    
    
//    public function save() {
//        $target_file =SITE_ROOT.'admin'.DS.$this->upload_directory.DS.$this->item_image;
//        if($this->id){
//            $this->update();
//            return TRUE;
//        } else {
//            if(!empty($this->errors)){
//                return FALSE;
//            }
//            if(empty($this->item_image || empty($this->tmp_path))){
//                $this->errors[] = 'the file not available';
//                return FALSE;
//            }
//            if(file_exists($target_file)){
//                $this->errors[] = "the file {$this->item_image} alreadey exists ";
//                return FALSE;
//            }
//            if(move_uploaded_file($this->tmp_path, $target_file)){
//                if($this->create()){
//                    unset($this->tmp_path);
//                    return TRUE;
//                }
//            } else {
//                $this->errors = 'check folder target permissions';
//                return FALSE;
//            }
//            
//        }
//    }
    
    
    
    
    public function picture_path() {
        return $this->upload_directory.DS.$this->item_image;
    }
    
    
    
    public function delete_post() {
        $picture_file = SITE_ROOT.'admin'.DS.$this->picture_path();
        if(file_exists($picture_file)){
            unlink($picture_file);
        }
        if($this->delete()){
            Junk::delete_junk('post_id', $this->id);
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
    
    
    
    
    
    
    
    public function extract_categories() {
        global $database;
        $this_post_id = $this->id;
        $categories = array();
        
        $sql = "SELECT * FROM categories
                JOIN junk
                ON categories.id = junk.category_id
                WHERE junk.post_id = {$this_post_id}
            ";

        $result = $database->query($sql);
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//            $row = array_shift($row);
            $categories[] = $row;
        }
        
        return $categories;
    }
    
    
    
    public function print_categories() {
        $categories = $this->extract_categories();
        foreach ($categories as $category){
        echo "<a class='label label-info' href=''>  {$category['category_title']} </a>";
        }
    }
    
}