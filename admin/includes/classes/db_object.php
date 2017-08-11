<?php

class Db_object {
    
    public $errors = array();
    
    public $upload_directory = 'images/posts';
    public static $db_row_count;
    public $image_placeholder = 'images/samp.jpg'/*'http://via.placeholder.com/64?text=image'*/;






    public $upload_errors_array = array(
        UPLOAD_ERR_OK => 'there is no error',
        UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded.' ,
        UPLOAD_ERR_NO_FILE    => 'There is no file to upload.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.'  
    );
    
    
    
    



















    //protected static $db_table = 'users';
    


    //////////////////////////////////   FIND ALL FUNCTION
    static function find_all($order='ASC'){
        return static::find_by_query("SELECT * FROM ". static::$db_table." ORDER BY id {$order}");
    }    //////////////////////////   END FIND ALL FUNCTION
    
    
    
        ////////////////////////////////////////////////////////////////////////////////  FIND BI ID FUNCTION
    static function find_by_id($id){
        $the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table." WHERE id = $id LIMIT 1");
        return !empty($the_result_array)? array_shift($the_result_array):FALSE;
    }    /////////////////////////////////////////////////////////////////////////////  END FIND BY ID FUNCTION
    
    
    
        ////////////////////////////////////////  FIND THIS QUERY FUNCTION
    public static function find_by_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set, MYSQLI_ASSOC)){
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
        //return $user;     
    }    //////////////////////////////////  END FIND THIS QUERY FUNCTION
    
    
    
        /////////////////////////////////////////////////////  INSTANTIATION FUNCTION
        public static function instantiation($the_record) {
        $caled_class = get_called_class();    
        $the_obj = new $caled_class;
        
        foreach ($the_record as $object_attribute => $value){
            if($the_obj->has_the_attribute($object_attribute)){
                $the_obj->$object_attribute = $value;
            } 
        } return $the_obj;
    }    //////////////////////////////////  END INSTANTIATION FUNCTION
    

    
        ///////////////////////////////////////  HAS THE ATTRIBUTE FUNCTION
    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }    //////////////////////////////////  END HAS THE ATTRIBUTE FUNCTION
    
    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////    
    //////////////////////properties FUNCTION/////////////////////////////// properties FUNCTION
    public function properties() {
        global $database;
        $properties = array();
        foreach (static::$db_fields as $db_field) {
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
                $properties[$db_field] = $database->escape_string($this->$db_field);
            }
        }
        return $properties;
    }//////////////////////properties FUNCTION/////////////////////////////// properties FUNCTION
     ////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////// ///////////////////////
    ///////////////////////////////////////////////////////////////////////////// CREATE FUNCTION
    public function create() {
        global $database; 
        $properties = $this->properties();
    
        $sql = "INSERT INTO " .  static::$db_table  . " (".  implode(', ', array_keys($properties)).")
                VALUES('".  implode("', '",  array_values($properties)) ."')";
        
        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return TRUE;
        } else {
            return FALSE;
        }
    } //////////////////////END CREATE FUNCTION////////////////////////////////END CREATE FUNCTION
    //////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////  UPDATE FUNCTION////////////////////////////////////  UPDATE FUNCTION
    public function update() {
        global $database;
        $id = $database->escape_string($this->id);
        $properties = $this->properties();
        $properties_pair = array();
        foreach ($properties as $key => $value) {
            $properties_pair[] = "$key = '{$value}'";
        } 
        
        $sql = "UPDATE " . static::$db_table . " SET ". implode(',', $properties_pair).
               " WHERE id = $id"
            ;
        $database->query($sql); 
        return (mysqli_affected_rows($database->connection)==1)? TRUE : FALSE;
   }   //////////////////////////////////////////////////END  UPDATE FUNCTIO
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////  
    /////////////////////////////////////////////////////  DELETE FUNCTION
    public function delete() {
        global $database;
        $id = $database->escape_string($this->id);
        
        $sql ="
            DELETE FROM " . static::$db_table . " 
            WHERE id = $id
            LIMIT 1
        ";
        
        $database->query($sql);
        return (mysqli_affected_rows($database->connection)==1)? TRUE : FALSE;
    }///////////////////////END DELETE FUNCTION//////////////////////////////  END DELETE FUNCTION
    ////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////// 
    ///////////////////////SAVE FUNCTION//////////////////////////////  SAVE FUNCTION
    public function save() {
        return (isset($this->id))? $this->update() : $this->create();   
    }//////////////////////END SAVE FUNCTION/////////////////////////////// END SAVE FUNCTION
    
    
        public function save_items_with_file() {
        $file = $_FILES['file_upload'];
        if($file['name']!=''){
            if($file['error']==0){
                $this->item_image = $file['name'];
                if(move_uploaded_file($file['tmp_name'], $this->item_image())){
                    return $this->save();
                }
            } else {
                $this->errors[] = $this->upload_errors_array[$file['error']];
            }
        }  else {
            return $this->save();
        }   
    }
    
    
    
    
    
    
    
    
    
    
    
    
        public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = 'ther was no file uploaded here';
            return FALSE;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return FALSE;
        } else {
            $this->filename = $file['name'];
            $this->item_image = $file['name'];
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
    
    
    
    
    
    public static function db_row_count() {
        global $database;
        $sql = "SELECT COUNT(*) FROM ".static::$db_table;
        
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }
    
    
    
    
    
    
    
    
    
    
    
    
        //////for show image
    public function item_image() {
        return empty($this->item_image)? $this->image_placeholder : $this->image_directory.DS.$this->item_image;
    }
    
    
    //////for delete image
    public function item_image_full_path() {
        return SITE_ROOT.'admin'.DS.$this->image_directory.DS.$this->item_image;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//    public function delete_row_and_file($param) {
//        if(file_exists($filename)){
//            if(unlink($filename)){
//                $this->delete();
//            }   
//        }
//    }
}

