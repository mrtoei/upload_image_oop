
<?php 

include('header.php');
$id = $_GET["id"];

?>
<script>
    $(document).ready(function(){
        $('#btn-upload').click(function(e){         
            e.preventDefault();  
            var formData = new FormData($('#form_upload_image')[0])
            $.ajax({
                type: "post",
                url: "upload.php",
                data: formData,
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    data.forEach(path => {
                        $("#show_image").append("<img src='"+path+"' >")
                    });              
                }
            });
        })
        $('#image_front').change(function(e){
            e.preventDefault();
            var formData = new FormData($('#image_front_form')[0])
            $.ajax({
                type: "post",
                url: "upload_image_front.php?id=<?=$id?>",
                data: formData,
                dataType:"json",
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    data.forEach(path => {
                        $("#show_image_front").append("<img src='"+path+"' >")
                    });              
                }
            });
        })
       
    })
</script>
    <?php
       
        $sql = "select  
            members.member_id, 
            members.member_firstname as firstname,
            members.member_lastname as lastname , 
            images.image_id, 
            images.url_front, 
            images.url_back 
        from members inner join images on images.member_id = members.member_id where members.member_id = '$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $url_front = "./images/default_card_id/default_front.jpg";
            $url_back = "./images/default_card_id/default_back.jpg";

            if($row['url_front']!='default_front'){
                $url_front = $row['url_front'];
            }

            if($row['url_back']!='default_back'){
                $url_front = $row['url_back'];
            }
    ?>
    
        <input type="hidden" name="member_id" id="member_id" value="<?=$row['member_id']?>">
        <input type="hidden" name="image_id" id="image_id" value="<?=$row['image_id']?>">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4>Upload Image</h4>
                </div>
            </div>
        <form id="form_upload_image">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> ชื่อ</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?=$row['firstname']?>">
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">สกุล</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?=$row['lastname']?>">
                    </div> 
                </div>
            </div>
        </form>

            <div class="row">
                <form id="image_front_form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlFile1"> หน้าบัตรประชาชน</label>
                        <input type="file" class="form-control-file" id="image_front" name="image_front" accept="image/*">
                    </div> 
                </div>
                </form>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">หลังบัตรประชาชน</label>
                        <input type="file" class="form-control-file" id="image_back" name="image_back" accept="image/*">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="show_image_front">
                    <img src="<?=$url_front?>">
                </div>
                <div class="col-md-6" id="show_image_back">
                    <img src="<?=$url_back?>">
                </div>
            </div>
            <!-- <div class="row">
                <div class="col">
                    <button type="sumbit" id="btn-upload" class="btn btn-primary">Upload</button>
                </div>
            </div> -->
        </div>

    <?php
        }
    ?>
<?php include('footer.php');?>

<!-- refer : https://www.ninenik.com/content.php?arti_id=722 -->