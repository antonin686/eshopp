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

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $name = $_POST["pname"];
            $price = $_POST["pprice"];
            $pid = $_POST["pid"];
            $quantity = $_POST["pquantity"];
            $xml = simplexml_load_file($file);

            $product = $xml->addChild('product');
            $product->addChild('name', $name);
            $product->addChild('pid', $pid);
            $product->addChild('price', $price);
            $product->addChild('quantity', $quantity);
            $product->addChild('status', "pending");

            $dom = new DOMDocument('1.0');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());
            $dom->save($file);

            header("location:seller.php");
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css"/>
</head>
<body>
    
    <div class="formbox">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="pname" value="axe"></td>
            </tr>

            <tr>
                <td>Product ID:</td>
                <td><input type="text" name="pid" value="100"></td>
            </tr>

            <tr>
                <td>Price:</td>
                <td><input type="text" name="pprice" value="500"></td>
            </tr>

            <tr>
                <td>Product ID:</td>
                <td><input type="text" name="pquantity" value="5"></td>
            </tr>

            <tr>
                <td><input type="submit" value="ADD"></td>
            </tr>
        </table>
    </form>
    </div>
    
</body>
</html>