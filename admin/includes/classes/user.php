<?php

class User extends db_object {
    protected static $db_table = 'users';
//    protected static $file_property = "this->item_image";
    protected static $db_fields = array('username', 'password', 'first_name', 'last_name', 'item_image', 'image_directory' );
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $item_image;
    public $image_directory = "images/users";

    




   



    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        
        $sql = "SELECT * FROM ". self::$db_table
             . " WHERE username = '{$username}'"
             . " AND password = '{$password}' ";
             
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array)? array_shift($the_result_array):FALSE;
        //return $the_result_array;   
    }
    /////////////////////////////////////////////////////////////////////
    
    
    
    
    
    
    
    public function prepare_user_for_update(){
        $file = $_FILES['file_upload'];
        if($file['name']!=''){
            if($file['error']==0){
                $this->image_directory = "images/users";
                if(!empty($this->item_image) && $this->image_directory != "images/postss"){
                    return $this->delete_item_image();
                }
            }
        }
    }







    
//    public function save_record_and_image() {
//        echo 'target:'.$target_file =SITE_ROOT.'admin'.DS.$this->upload_directory.DS.$this->item_image ;
////        //if($this->id){
////        //    $this->update();
////        //    return TRUE;
////        //} else {
//            if(!empty($this->errors)){
//                return FALSE;
//            }
//            if(empty($this->item_image || empty($this->tmp_path))){
//                $this->errors[] = 'the file not available';
//                return FALSE;
//            }
//            if(file_exists($target_file)){
//                $this->errors[] = "the file {$this->item_image } alreadey exists ";
//                return FALSE;
//            }
//            if(move_uploaded_file($this->tmp_path, $target_file)){
//                echo 'file movved';
//                if($this->save()){
//                    unset($this->tmp_path);
//                    return TRUE;
//                }
//            } else {
//                $this->errors = 'check folder target permissions';
//                return FALSE;
//            }
//            
////        //}   
//    }
    
    
    
    
    
    
    ////////////////////////////////////////////////////// DELETE USER IMAGE FILE
    public function delete_item_image() {
        if(!empty($this->item_image)){
            if(file_exists($this->item_image_full_path())){
                if(unlink($this->item_image_full_path())){
                    $this->item_image = '';
                    return $this->save();
                }
            }
        }
    }
    
    
    
    
    ////////////////////////////////////////////////////// DELETE USER
    public function delete_user() {
        if(!empty($this->item_image)){
            if($this->delete_item_image()){
                return $this->delete();
            }
        }  else {
            return $this->delete();
        }
    }
    
    
    
    
    ///////////////////////////////////////////////// 
    public function ajax_save_item_image($item_image, $user_id) {
        
        if($this->image_directory == "images/users" && !empty($this->item_image)){
            $this->delete_item_image();
        }
        
        $this->image_directory = "images/posts";
        $this->item_image      = $item_image;
        $this->id              = $user_id;
        $this->save();
//        global $database;
//        $sql = "UPDATE ".self::$db_table." SET item_image = '{$this->item_image}' ";
//        $sql.= "WHERE id = '{$this->id}'";
//        $update_image = $database->query($sql);
    }
   
      
      
    
}////////////////////////////////////////////////////// ENDS OF USER CLASS





//$user = User::find_by_id($session->user_id);
