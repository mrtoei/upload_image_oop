<?php
include('./upload_image.php');
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$user = [
    'firstname' => $firstname,
    'lastname'=> $lastname
];
$obj_db = new db();
$member_id = $obj_db->insert_user($user);
if($member_id){
    $sum = 0;

    // Move images
    $obj = new upload_image();
    $url_image_front = $obj->upload($_FILES['image_front']);
    $url_image_back = $obj->upload($_FILES['image_back']);

    $insert_image_front = $obj_db->insert_image($member_id,$url_image_front,'front');
    if($insert_image_front==200){
        $sum+=1;
    }
    $insert_image_back = $obj_db->insert_image($member_id,$url_image_back,'back');
    if($insert_image_back==200){
        $sum+=1;
    }

    if($sum==2){
        echo json_encode($obj_db->get_url_image($member_id));
    }
}


// echo $image_front , "<br>";
// echo $image_back , "<br>";
