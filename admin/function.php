<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php 
    $connection = new mysqli( 'localhost' , 'root' , '' , 'db_php_3' );

    function   upload_file($img_name){
        $part  =  '../images/'.$img_name;
        move_uploaded_file($_FILES['_file']['tmp_name'] , $part);
    }
    function AddPro(){
        global $connection ;
        if(isset($_POST['_AddPro'])){

            $name       =   $_POST['_name'];
            $image      =   $_FILES['_file']['name'];
            $category   =   $_POST['_category'];
            $brand      =   $_POST['_brand'];
            $price      =   $_POST['_price'];
            
            if( !empty($name) && !empty($category) && !empty($brand) && !empty($price) && !empty($image ) ){
                $thumbnail = date('YmdHis').'-'.$image;
                upload_file($thumbnail);
                $sql_insert = "
                                INSERT INTO `product` ( `name` , `thumbnail` , `price` , `category` , `brand` ) 
                                                VALUES  ( '$name' , '$thumbnail' , '$price', '$category' , '$brand' ) ;
                            ";
                $result  =  $connection -> query($sql_insert);
                if($result) echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Data Inserted",
                            text: "You inserted product",
                            icon: "success",
                            button: "Confirm",
                        });
                    })
                </script>
                ';
            } 
            else echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Data Inserted ",
                            text: "You can not inserted product",
                            icon: "error",
                            button: "Confirm",
                        });
                    })
                </script>
                ';
            }
    }
    AddPro(); 

    function ShowPro(){
        global $connection ;
        $sql_show = "
                        SELECT * FROM `product` WHERE `is_delete` = 0 ORDER BY `id` ASC ; 
                    ";
        $result = $connection -> query($sql_show);
        while ($row = mysqli_fetch_assoc($result)){
            echo '
            <tr>
                <td><img class="pic" src="../images/'.$row['thumbnail'].'" alt="'.$row['thumbnail'].'"></td>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['category'].'</td>
                <td>'.$row['brand'].'</td>
                <td>'.$row['price'].'</td>
                <td>
                <form method="post" >
                        <button class=" btn btn-success" type="button" id="OpenEdit" name="_OpenEdit"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</button>

                        <button class=" btn btn-secondary type="button" name="_delete" value='.$row['id'].'>Delete</button>
                    </form>
                </td>
            </tr>
            ';
        }
    }

    function EditPro(){
        if(isset($_POST['_Edit'])){
            global $connection;
            $update_id  =   $_POST['_id'];
            $name       =   $_POST['_name'];
            $category   =   $_POST['_category'];
            $brand      =   $_POST['_brand'];
            $price      =   $_POST['_price'];
            $old_img    =   $_POST['_old_img'];
            $new_img    =   $_FILES['_file']['name'];
            if(!empty($name) && !empty($category) && !empty($price) && !empty($brand)){
                if(empty($new_img))  
                    $thumbnail = $old_img;
                else{
                    $thumbnail = date('YmdHis').'-'.$new_img;                 
                    upload_file($thumbnail);
                }

                $sql_edit = "
                                UPDATE  `product` SET   `name`      = '$name' ,
                                                        `category`  = '$category' ,
                                                        `brand`     = '$brand' ,
                                                        `thumbnail` = '$thumbnail' ,
                                                        `price`     = '$price'
                                                WHERE   `id`        = '$update_id' ; 
                            ";
                $result  = $connection -> query($sql_edit);
                if($result) echo'
                                <script>
                                    $(document).ready(function(){
                                        swal({
                                            title: "Data Update",
                                            text: "You Updated product",
                                            icon: "success",
                                            button: "Confirm",
                                        });
                                    })
                                </script>
                                ';
            }
            else echo'
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Data Update ",
                                text: "You can not Update product",
                                icon: "error",
                                button: "Confirm",
                            });
                        })
                    </script>
                    ';
        }
    }
    EditPro();

    function DeletePro(){
        if(isset($_POST['_delete'])){
            global $connection;
            $remove_id = $_POST['_delete'];
            $sql_remove = "
                            UPDATE `product` SET `is_delete` = 1 WHERE `id` = '$remove_id';
                          ";
            $result = $connection -> query($sql_remove);
            if($result) echo '
                                <script>
                                    $(document).ready(function(){
                                        swal({
                                            title: "Data Inserted",
                                            text: "You inserted product",
                                            icon: "success",
                                            button: "Confirm",
                                        });
                                    })
                                </script>
                             ';
        }
    }
    DeletePro();

    function ShowProremove(){
        global $connection ;
        $sql_show = "
                        SELECT * FROM `product` WHERE `is_delete` = 1 ORDER BY `id` ASC ; 
                    ";
        $result = $connection -> query($sql_show);
        while ($row = mysqli_fetch_assoc($result)){
            echo '
            <tr>
                <td><img class="pic" src="../images/'.$row['thumbnail'].'" alt="'.$row['thumbnail'].'"></td>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['category'].'</td>
                <td>'.$row['brand'].'</td>
                <td>'.$row['price'].'</td>
                <td>
                    <form method="post">
                        <button class=" btn btn-success"  name="_recycle" value='.$row['id'].' >Recycle</button>
                        <button class=" btn btn-secondary" name="_remove"  value='.$row['id'].' >Remove</button>
                    </form>
                </td>
            </tr>
            ';
        }
    }

    function gotoTrash(){
        if(isset($_POST['_gotoTrash'])){
            session_start();
            header('location: Trash.php');
        }
    }
    gotoTrash();
    

    function gotoDashboard(){
        if(isset($_POST['_gotoTodashboard'])){
            session_start();
            header('location: dashboard.php');
        }
    }
    gotoDashboard();
    function Recyclebin(){
        if(isset($_POST['_recycle'])){
            global $connection;
            $recycle_id = $_POST['_recycle'];
            $sql_recycle = "
                            UPDATE `product` SET `is_delete` = 0 WHERE `id` = '$recycle_id';
                          ";
            $result = $connection -> query($sql_recycle);
                        if($result) echo '
                                <script>
                                    $(document).ready(function(){
                                        swal({
                                            title: "Data recycle bin",
                                            text: "You recycled product",
                                            icon: "success",
                                            button: "Confirm",
                                        });
                                    })
                                </script>
                             ';
        }
    }
    Recyclebin();

    function Removebin(){
        if(isset($_POST['_remove'])){
            global $connection;
            $id_remove = $_POST['_remove'];
            $sql_remove = "
                            DELETE FROM `product` WHERE `id` = '$id_remove' ;
                          ";
            $result = $connection -> query($sql_remove);
            if($result) echo '
                            <script>
                                $(document).ready(function(){
                                    swal({
                                        title: "Data Remove",
                                        text: "You Remove product",
                                        icon: "success",
                                        button: "Confirm",
                                    });
                                })
                            </script>
                             ';
        }
    }
    Removebin();
