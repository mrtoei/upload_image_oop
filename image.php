<?php
include('./connect.php');
class Image{
    public $connect;
    private $movedImage;
    public function __construct()
    {
        $db_connect = new db_connect();
        $this->connect = $db_connect->connect();
    }

    public function checkImage($id,$side, $file){
        $path = null;
        $upload = false;
        $sql = "select * from images where member_id='$id'";
        $result = mysqli_query($this->connect, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if($side=='front'){
                if($row['url_front']=="default_front"){
                    $path = $this->movedImage($file);
                    if($path){
                        $upload = true;
                    }
                }else{
                    $path = $row['url_front'];
                    $removedImage = $this->removedImage($path);
                    if($removedImage==200){
                        $path = $this->movedImage($file);
                        if($path){
                            $upload = true;
                        }
                    }
                }
            }
        }

        if($upload === true){
           if($this->uploadImage($path,$id,$side)==200){
               echo json_encode($path);
           }
        }
    }

    private function movedImage($file){
        // echo "<pre>";
        // print_r($file);
        // echo "</pre>";
        $filename = $file["name"];
        $path = './images/'.$filename;

        $moved  = move_uploaded_file($file["tmp_name"],$path);
        if($moved){
            return $path;
        }
    }

    private function removedImage($path){
        // echo "Removed  : $path";
        $removedImage = false;
        $unlink = null;
        if(file_exists($path)){
           if(unlink($path)){
               return 200;
           }
        }else{
            return 200;
        }   
    }

    private function uploadImage($path,$id,$side){
        if($side=='front'){
            $sql = "update images set url_front='$path' where member_id='$id'";
        }

        if (mysqli_query($this->connect, $sql)) {
            return 200;
        }
    }
}