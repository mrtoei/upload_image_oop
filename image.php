<?php
include('./connect.php');
class Image{
    public $connect;
    public function __construct()
    {
        $db_connect = new db_connect();
        $this->connect = $db_connect->connect();
    }

    public function checkImage($id,$side, $file){
        $sql = "select * from images where member_id='$id'";
        // echo $id;
        $result = mysqli_query($this->connect, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if($side=='front'){
                if($row['url_front']=="default_front"){

                }
            }
        }
    }

    private function movedImage($file){
        $filename = $file["name"];
        $path = './images/'.$filename;

        $moved  = move_uploaded_file($file["tmp_name"],$path);
        if($moved){
            return $path;
        }
    }

    private function upload_image($path,$id,$side){
        $sql = "";
    }
}