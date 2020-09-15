<?php 

session_start();

$message = "";

if (isset($_POST['btn-action'])) {
    
    switch ($_POST['btn-action']) {
        
        case 'add':
           
            if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                $id = openssl_decrypt($_POST['id'],COD,KEY);
                $message = "ok correct id: ".$id."<br/>";
            }else{
                $message = "error incorrect id: ".$id;
            }
            if(is_string(openssl_decrypt( $_POST['name'], COD, KEY))){
                $NAME = openssl_decrypt( $_POST['name'], COD, KEY);
                $message.="name: ".$NAME."<br/>";
            }else{
                $message.="error, something's wrong: ".$NAME."<br/>";
            }
            if(is_numeric(openssl_decrypt( $_POST['cantidad'], COD, KEY))){
                $CANTIDAD = openssl_decrypt( $_POST['cantidad'], COD, KEY);
                $message.="cantidad: ".$CANTIDAD."<br/>";
            }else{
                $message.="error, something's wrong: ".$CANTIDAD."<br/>";
            }
            if(is_numeric(openssl_decrypt( $_POST['price'], COD, KEY))){
                $PRICE = openssl_decrypt( $_POST['price'], COD, KEY);
                $message.="the price is: ".$PRICE."<br/>";
            }else{
                $message.="error, something's wrong: ".$PRICE."<br/>";
            }

            if(!isset($_SESSION['CARRITO'])){
                $producto = array(
                    'id'=>$id,
                    'NAME'=>$NAME,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRICE'=>$PRICE
                );
                $_SESSION['CARRITO'][0] = $producto;
                $message = "product added succesfully";
            }else{

                $idProducts = array_column($_SESSION['CARRITO'], "id");
                
                if(in_array($id,$idProducts)){

                    echo "<script>alert('product already selected');</script>";
                    $message = ""; //hide the message

                }else{

                $NumeroProductos = count($_SESSION['CARRITO']);
                $producto = array(
                    'id'=>$id,
                    'NAME'=>$NAME,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRICE'=>$PRICE
                );
                $_SESSION['CARRITO'][$NumeroProductos] = $producto;
                $message = "product added succesfully";
            }
            }
            // $message = print_r( $_SESSION, true);

        break;

        case "delete":
            if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                $id = openssl_decrypt($_POST['id'],COD,KEY);
                
                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                    if($producto['id']==$id){
                        unset($_SESSION['CARRITO'][$indice]); // delete the register
                        echo "<script>alert('product deleted');</script>";
                    }
                }

            }else{
                $message = "error incorrect id: ".$id;
            }
        break;
    }

}

?>