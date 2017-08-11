<?php

class Paginate {
    public $current_page;
    public $items_per_page;
    public $items_total_count;
    
    function __construct($page=1, $items_per_page=3, $items_total_count=0) {
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$items_per_page;
        $this->items_total_count = (int)$items_total_count;
    }
    
    
    
    public function next_page() {
        return $this->current_page + 1;
    }
    
    
    
    
    public function previous_page() {
        return $this->current_page - 1;
    }
    
    
    
    public function pages_total(){
        return ceil($this->items_total_count / $this->items_per_page);
    }
    
    
    
    public function has_next() {
        return $this->next_page() <= $this->pages_total() ?  TRUE :  FALSE;
    }
    
    
    public function has_previous() {
        return $this->previous_page() >=1 ? TRUE : FALSE;
    }

    
    
    public function offset() {
        return ($this->current_page - 1) * $this->items_per_page;
    }
}

