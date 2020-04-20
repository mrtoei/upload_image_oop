
<?php include('header.php');?>
    <div class="container">
        <div class="row">
            <div class="col">
                    <h3>รายชื่อลูกค้า</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">สกุล</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                <?php
                    $sql = "select * from members";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['member_id'];
                            
                        ?>
                        <tr>
                            <td><?=$row['member_firstname']?></td>
                            <td><?=$row['member_lastname']?></td>
                            <td>
                                <a href="view.php?id=<?=$id?>">Edit</a>
                            </td>
                        </tr>
                        <?php
                        }
                    }else{
                        ?>
                        <tr >
                            <td colspan="3">ไม่มีข้อมูล</td>
                        </tr>
                        <?php
                    }
                ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include('footer.php');?>