<?php
    header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
    if (is_uploaded_file($_FILES['gambarproduk']['tmp_name']))
    {
        if(isset($_POST['produkid']))
        {
            
            $produkid = $_POST['produkid'];
            $gambarproduk = $_FILES['gambarproduk']['tmp_name'];

            $produkcontroller = new ProdukController();
            $produk = $produkcontroller->getProdukByProdukId($produkid);

            if($produk != null)
            {
                $name = $_FILES["gambarproduk"]["name"];
                $ext = end((explode(".", $name))); 

                $path = "../Images/Products/".$produkid.".".$ext;
                $newpath = "http://letshoppa.itmaranatha.org/Images/Products/".$produkid.".".$ext;
                if($produkcontroller->putProdukGambarProduk($produkid, $newpath))                  
                {
                    move_uploaded_file ($_FILES['gambarproduk'] ['tmp_name'], $path);

                    $result["success"]=1;
                    $result["message"]="Success";
                }
                else
                {
                    $result["success"]=5;
                    $result["message"]="Bad Request or Internal Error";
                }
            }
            else
            {
                $result["success"]=4;
                $result["message"]="Bad Request";
            }
        }
        else
        {
            $result["success"]=4;
            $result["message"]="Bad Request";
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>