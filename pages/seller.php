<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css"/>
</head>
<body>
    <div class="box">
        <table>

            <?php 
                $dom = simplexml_load_file("../xml/seller.xml");

                foreach($dom->product as $p)
                {
                    echo "<tr>";
                        echo "<td>".$p->name."</td>";
                        echo "<td>".$p->pID."</td>";
                        echo "<td>".$p->price."</td>";
                        echo "<td>".$p->quantity."</td>";
                    echo "</tr>";
                }
            ?>

            <a href="addProduct.php" class="button">Add Product</a>
    </table>    
    </div>
</body>
</html>