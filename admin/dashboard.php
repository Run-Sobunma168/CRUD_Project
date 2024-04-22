<?php 
    include 'function.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminDashboard</title>
    <?php include "../link/link.php";?> 
    <style>
        .header{
            height: 100px;
            border-radius: 10px;
        }
        .pic{
            width: 4rem;
            height: 4rem;
        }
        .table{
            table-layout: fixed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header w-100 d-flex justify-content-between align-items-center border border-5  border-info-subtle  p-5 mt-5">
            <div class="title text-warning "><h1 >Admin</h3></div>
            <form method="post">
                    <button class="btn btn-outline-primary " type="button" id="OpendAdd" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ADD</button>
                    <button class="btn btn-outline-info " name="_gotoTrash">Trash</button>
            </form>
        </div>
        <table class="table w-100 mt-3 align-middle " >
            <tr >
                <th>Picture</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <!-- <tr>
                <td><img class="pic" src="../image/Shose1.png" alt=""></td>
                <td>01</td>
                <td>nike</td>
                <td>nike</td>
                <td>nike</td>
                <td>102$</td>
                <td>
                    <button class=" btn btn-success ">Edit</button>
                    <button class=" btn btn-secondary ">Delete</button>
                </td>
            </tr> -->
            <?php ShowPro(); ?>
        </table>
    </div>
<?php 
    include 'modal.php';
?>
</body>
</html>

<script>
    $(document).ready(function(){

        $("#OpendAdd").click(function(){
            $("#accept_add").show();
            $("#accept_edit").hide();
        })

        $("body").on( "click" , "#OpenEdit" , function(){
            $("#accept_add").hide();
            $("#accept_edit").show();
            var thumbnail = $(this).parents('tr').find('td:eq(0) img').attr('alt');
            var id = $(this).parents('tr').find('td').eq(1).text();
            var name = $(this).parents('tr').find('td').eq(2).text();
            var category = $(this).parents('tr').find('td').eq(3).text();
            var brand = $(this).parents('tr').find('td').eq(4).text();
            var price = $(this).parents('tr').find('td').eq(5).text();
            $("#id").val(id);
            $("#name").val(name);
            $("#category").val(category);
            $("#brand").val(brand);
            $("#price").val(price);
            $("#old_img").val(thumbnail);
        })


    })
</script>