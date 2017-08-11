<?php

class Photo extends Db_object {
    protected static $db_table = 'photos';
//    protected static $file_property = '$this->filename';
    protected static $db_fields = array('title', 'caption', 'filename', 'alternate_text', 'type', 'size' );
    public $id;
    public $title;
    public $caption;
    public $filename;
    public $alternate_text;
    public $type;   
    public $size;  
    
    public $tmp_path;
    
    
    
    
    // some function return $_file
    
    
    
    
    
    
    public function save() {
        $target_file =SITE_ROOT.'admin'.DS.$this->upload_directory.DS.$this->filename;
        if($this->id){
            $this->update();
            return TRUE;
        } else {
            if(!empty($this->errors)){
                return FALSE;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = 'the file not available';
                return FALSE;
            }
            if(file_exists($target_file)){
                $this->errors[] = "the file {$this->filename} alreadey exists ";
                return FALSE;
            }
            if(move_uploaded_file($this->tmp_path, $target_file)){
                if($this->create()){
                    unset($this->tmp_path);
                    return TRUE;
                }
            } else {
                $this->errors = 'check folder target permissions';
                return FALSE;
            }
            
        }
    }
    
    
    
    
    public function picture_path() {
        return $this->upload_directory.DS.$this->filename;
    }
    
    
    
    public function delete_photo() {
        $picture_file = SITE_ROOT.'admin'.DS.$this->picture_path();
        if(file_exists($picture_file)){
            unlink($picture_file);
        }
        if($this->delete()){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
    
}