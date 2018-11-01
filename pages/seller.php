<?php 
    session_start();

    if(empty($_SESSION['activeUser']))
    {
        header("location:register.php");
    }
    else
    {
        $user = $_SESSION['activeuser'];
        $file = "../xml/".$user.".xml";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css"/>
</head>
<body>
    <div class="box">
        <table>
        <a href="addProduct.php" class="button">Add Product</a>
            <tr>
                <td>Name</td>
                <td>Product ID</td>
                <td>Price</td>
                <td>Status</td>
            </tr>
            <?php 
                $dom = simplexml_load_file($file);

                foreach($dom->product as $p)
                {
                    echo "<tr>";
                        echo "<td>".$p->name."</td>";
                        echo "<td>".$p->pid."</td>";
                        echo "<td>".$p->price."</td>";
                        echo "<td>".$p->status."</td>";
                    echo "</tr>";
                }
            ?>    
            

    </table>    
    </div>
</body>
</html>