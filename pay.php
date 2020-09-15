<?php 

include 'global/config.php';
include 'global/connect.php';
include 'shopping_cart.php';
include 'templates/header.php';

?>

<?php 

if($_POST){

    $total=0;

    $SID=session_id(); // key session from CARRITO

    foreach($_SESSION['CARRITO'] as $indice=>$producto){

        $total=$total+($producto['PRICE']*$producto['CANTIDAD']);

    }

    // INSERT INTO `tienda`.`tblventas` (`id`, `fecha`, `correo`, `total`, `status`) VALUES ('3123213', '2020-09-11 23:28:32', 'luisjoselopezd@gmail.com', '100', 'pendiente');

    echo "<h3>".$total."</h3>";

}

?>

<?php include 'templates/footer.php'; ?>