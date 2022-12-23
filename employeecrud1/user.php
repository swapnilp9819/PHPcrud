<?php

require_once 'database.php';

class user extends database{
    protected $tablename="usertable";


    // Function to add users

    public function add($data){
        if(!empty($data)){
            $fileds=$placeholder=[];
            foreach($data as $field => $value){
                $fileds[]=$field;
                $placeholder[]=":{$field}";
            }
        }




        $sql="INSERT INTO {$this->tablename} (". implode(',',$fileds) .") VALUES (". implode(',',$placeholder).")";

        $stmt = $this->conn->prepare($sql);
        try{
            $this->conn->beginTranscation();
            $stmt->execute($data);
            $lastInsertedId=$this->conn->lastInsertId;
            this->conn->commit();
            return $lastInsertedId;

        }catch(PDOException $e){
            echo "Error:".$e -> getMessage();
            $this->conn->rollback();
        }
    }

    // Function to get rows

    public function getRows($start=0,$limit=4){
        $sql="SELECT * FROM {$this->tablename} ORDER BY LIMIT {$start},{$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $results=$stmt->fetchALL(PDO::FETCH_ASSOC);
        }else{
            $results=[];
        }
        return $results;
    }


    // function to get single row

    public function getRow($field,$value){
        $sql="SELECT * FROM {$this->tablename} WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            $result=[];
        }
        return $result;
    }

    // function to count number of rows

    public function getCount(){
        $sql="SELECT count(*) as pcount from {$this->tablename}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pcount'];
    }

    // function to upload photo

    public function uploadPhoto($file){
        if(!empty($file)){
            $fileTempPath=$file['tmp_name'];
            $fileName=$file['name'];
            $fileType=$file['type'];
            $fileNameCmps=explode('.',$fileName);
            $fileExtension=strtolower(end($fileNameCmps));
            $newFileName=md5(time().$fileName) . '.' . $fileExtension;
            $allowedExtn=["png","jpg","jpeg"];

            if(in_array($fileExtension,$allowedExtn)){
                $uploadFileDir=getcwd().'/uploads/';
                $destFilePath=$uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTempPath,$destFilePath)){
                    return $newFileName;
                }
            }
        }
    }

    // function to update

    public function update($data,$id){
        if(!empty($data)){
            $dields="";
            $x=1;
            $fieldsCount=count($data);
            foreach($data as $field=>$value){
                $fields.="{$field}=:{$field}"
                if($x<$fieldsCount){
                    $fields.=",";
                }
                $x++;
            }
        }
        $sql="UPDATE {$this->tablename} SET {$fields} where id=id";
        $stmt = $this->conn->prepare($sql);
        try{
            $this->conn->beginTranscation();
            $data['$id']=$id;
            $stmt->execute($data);
            this->conn->commit();

        }catch(PDOException $e){
            echo "Error:".$e -> getMessage();
            $this->conn->rollback();
        }
    }



    // function to delete
    public function deleteRow($id){
        $sql="DELETE FROM {$this->tablename} WHERE id:id";
        $stmt = $this->conn->prepare($sql);
        try{
            $stmt=execute([':id'=>$id]);
            if($stmt->rowCount()>0){
                return true;
            }
        }catch(PDOException $e){
            echo "Error:".$e -> getMessage();
            return false;
        }
    }


    // function for search
}

?>