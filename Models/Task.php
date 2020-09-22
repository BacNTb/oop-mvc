<?php

namespace Mvc\Models;

use Mvc\Core\Model;

use Mvc\Config\Database;

class Task extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $created_at;
    protected $updated_at;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->created_at = date("Y-m-d h:i:s");
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->updated_at = date("Y-m-d h:i:s");
    }

}
