<?php

namespace Mvc\Core;

use Mvc\Core\ResourceModelInterFace;
use Mvc\Config\Database;

class ResourceModel implements ResourceModelInterFace
{
    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        $id = $model->getId();

        $arr = $model->getProperties();
        $newArr = [];
        
        if ($id) {
            $values = "";

            foreach ($arr as $key => $value) {
                if($key != "id" && $key != "created_at") {
                    $values .= "$key = :$key ,";
                    $newArr[$key] = $value;
                }
            }

            $trimValues = trim($values, ",");

            $sql = "UPDATE $this->table SET $trimValues WHERE id = $id";

            $req = Database::getBdd()->prepare($sql);

            return $req->execute($newArr);

        } else {
            $values = "";
            $keys = "";

            foreach ($arr as $key => $value) {
                if($key != "id" && $key != "updated_at") {
                    $keys .= "$key ,";
                    $values .= "'$value' ,";
                    $newArr[$key] = $value;
                }
            }

            $trimKeys = trim($keys, ",");
            $trimValues = trim($values, ",");

            $sql = "INSERT INTO $this->table ($trimKeys) VALUES ($trimValues)";
            
            $req = Database::getBdd()->prepare($sql);

            return $req->execute($newArr);
        }
    }

    public function delete($model)
    {
        $id = $model->getId();

        if($id){
            $sql = "DELETE FROM $this->table WHERE id = $id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute();
        }
    }

    public function getAll(){
        $sql =  "SELECT * FROM $this->table";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()) {
            return $req->fetchAll();
        }
    }

    public function showTask($id){
        $sql =  "SELECT * FROM $this->table WHERE id = $id";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()){
            return  $req->fetch();
        }
    }
}
