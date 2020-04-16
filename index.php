้<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <title>Upload Image</title>
</head>
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
       
    })
</script>
<body>
    <form id="form_upload_image">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4>Upload Image</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for=""> ชื่อ</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">สกุล</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlFile1"> หน้าบัตรประชาชน</label>
                        <input type="file" class="form-control-file" id="image_front" name="image_front" accept="image/*">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">หลังบัตรประชาชน</label>
                        <input type="file" class="form-control-file" id="image_back" name="image_back" accept="image/*">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="sumbit" id="btn-upload" class="btn btn-primary">Upload</button>
                </div>
            </div>

            <div class="row">
                <div class="col" id="show_image">
                    
                </div>
            </div>
        </div>
    </form>
</body>
</html>

<!-- refer : https://www.ninenik.com/content.php?arti_id=722 -->