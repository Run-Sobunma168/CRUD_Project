<?php
$connection = new mysqli ('localhost' , 'root' , '' , 'db_php_3');
function showCart(){
    global $connection;
    $sql_ShowCart = "
                        SELECT *FROM `product` WHERE `is_delete` = 0  ORDER BY `id` DESC ; 
                    ";
    $result = $connection -> query($sql_ShowCart);
    while( $row = mysqli_fetch_assoc($result)){
        echo '
        <div class="card shadow border-0 m-2 mt-5 " style="width: 18rem;">
            <img src="../../images/'.$row['thumbnail'].'" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">'.$row['name'].'</h5>
                <p class="card-text">'.$row['price'].'</p>
                <a href="#" class="btn btn-warning"><span>Buy Now</span></a>
            </div>
        </div>
        ';
    }
}