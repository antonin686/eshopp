<?php 
    session_start();
    $user = "";
    if(empty($_SESSION['activeUser']))
    {
        header("location:register.php");
    }
    else
    {
        $user = $_SESSION['activeUser'];
        $file = "../xml/products.xml";
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
                <td>Image</td>
                <td>Product ID</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Status</td>
            </tr>
            <?php 
                $dom = simplexml_load_file($file);

                foreach($dom->product as $p)
                {
                        echo "<tr>";
                        echo "<td>".$p->name."</td>";
                        echo "<td><img style='width: 80px;height:80px' src='".$p->img."'></td>";
                        echo "<td>".$p->pid."</td>";
                        echo "<td>".$p->price."</td>";
                        echo "<td>".$p->quantity."</td>";
                        echo "<td>".$p->status."</td>";
                        echo "</tr>";
                          
                }
            ?> 
        </table>    
    </div>
</body>
</html>