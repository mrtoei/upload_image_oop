<?php

class upload_image{

    public function upload($file){
        // echo "<pre>";
        // print_r($file);
        // echo "</pre>";
        $filename = $file["name"];
        $path = './images/'.$filename;

        $moved  = move_uploaded_file($file["tmp_name"],$path);
        if($moved){
            return $path;
        }
        // return $path;
    }
}


class db{
    
    public function insert_user($data){
        include('./connect.php');
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $sql = "insert into members (member_firstname,member_lastname) values ('$firstname','$lastname')";
        if (mysqli_query($conn, $sql)) {
            return $last_id = mysqli_insert_id($conn);
        } else {
            return "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
    }

    public function insert_image($member_id,$url,$position){
        include('./connect.php');
        $sql = "insert into images (member_id,url,type) values ('$member_id','$url','$position')";
        if (mysqli_query($conn, $sql)) {
            return 200;
        }
    }

    public function get_url_image($member_id){
        $path = array();
        include('./connect.php');
        $sql = "select * from images where member_id = '$member_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $i=0;
            while($row = mysqli_fetch_assoc($result)) {
               array_push($path, $row['url']);
            }
        }

        return $path;
    }
}