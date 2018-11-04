<?php
    session_start();
    //Check if logged in
    $file = "../xml/products.xml";
    $xml = simplexml_load_file($file);
    $pid = $xml->productInfo->productSerial + 1;
    $error = "";
    if(empty($_SESSION['activeUser']))
    {
        header("location:register.php");
    }else
    {
        //check if submit
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $user = $_SESSION['activeUser'];
            $imgPath = "../uploads/" . basename($_FILES["ppic"]["name"]);
            $name = $_POST["pname"];
            $price = $_POST["pprice"];
            $quantity = $_POST["pquantity"];
            $type = $_POST["ptype"];


                if( is_uploaded_file($_FILES['ppic']['tmp_name']))
                {
                    uploadImg() ;
            
                    $xml = simplexml_load_file($file);

                    $xml->productInfo->productSerial += 1;
                    $product = $xml->addChild('product');
                    //$product->addChild('username', $user);
                    $product->addChild('pid', $pid);
                    $product->addChild('name', $name);
                    $product->addChild('type', $type);
                    $product->addChild('img', $imgPath);
                    $product->addChild('price', $price);
                    $product->addChild('quantity', $quantity);
                    $product->addChild('status', "pending");
                    

                    $dom = new DOMDocument('1.0');
                    $dom->preserveWhiteSpace = false;
                    $dom->formatOutput = true;
                    $dom->loadXML($xml->asXML());
                    $dom->save($file);

                    header("location:seller.php");
                }else{
                    $error = "<span style='color:red;'>Select a Picture!!!</span>";
                }
                
            
            
        }

        
    }

    function uploadImg()
    {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["ppic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        
            $check = getimagesize($_FILES["ppic"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["ppic"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["ppic"]["tmp_name"], $target_file)) {
               // echo "The file ". basename( $_FILES["ppic"]["name"]). " has been uploaded.";
                //echo $target_file;
                
                
            } else {
               // echo "Sorry, there was an error uploading your file.";
            }
        }
        return $uploadOk;
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

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
        
            <table>
                <tr>
                    <td>Product ID:</td>
                    <td><input type="text" name="pid" value="<?php echo $pid ?>" readonly/></td>
                </tr>

                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="pname" value="axe"/></td>
                </tr>

                <tr>
                    <td>Product Type:</td>
                    <td>
                        <select name="ptype" >
                            <option value="man">Man</option>
                            <option value="woman">Woman</option>
                            <option value="kid">Kid</option>
                            <option value="other">Other</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="pprice" value="500"/></td>
                </tr>

                <tr>
                    <td>Quantity:</td>
                    <td><input type="number" name="pquantity" value="5"/></td>
                </tr>

                <tr>
                    <td>Upload Image:</td>
                    <td><input type="file" name="ppic" id="ppic" accept="image/*"/></td>
                </tr>

                <tr>
                    <td><input type="submit" value="ADD"/></td>
                </tr>
                <tr>
                    <td><?php echo $error?></td>
                </tr>
            </table>
            
        </form>
    
    </div>
    
</body>
</html>