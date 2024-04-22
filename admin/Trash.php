<?php 
    include 'function.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash</title>
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
            <div class="title text-warning "><h1 >Tarsh</h3></div>
            <form method="post">
                <button class="btn btn-outline-primary " type="submit" name="_gotoTodashboard" >Back to Admin</button>
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
            <?php ShowProRemove(); ?>
        </table>
    </div>
<?php 
    include 'modal.php';
?>
</body>
</html>

