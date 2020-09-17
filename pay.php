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

    $correo=$_POST['email'];

    foreach($_SESSION['CARRITO'] as $indice=>$producto){

        $total=$total+($producto['PRICE']*$producto['CANTIDAD']);

    }

    $sentence=$pdo->prepare("INSERT INTO `tblventas` (`id`, `clave`, `paypal`, `fecha`, `correo`, `total`, `status`) VALUES (NULL,:clave, '', NOW(),:correo,:total, 'pending');");

    $sentence->bindParam(":clave",$SID);
    $sentence->bindParam(":correo",$correo);
    $sentence->bindParam(":total",$total);
    $sentence->execute();
    $idVenta=$pdo->LastInsertId();

    foreach($_SESSION['CARRITO'] as $indice=>$producto){

    $sentence=$pdo->prepare("INSERT INTO 
    `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
    VALUES (NULL,:IDVENTA,:IDPRODUCTO,:PRECIOUNITARIO,:CANTIDAD, '0');");

    $sentence->bindParam(":IDVENTA",$idVenta);
    $sentence->bindParam(":IDPRODUCTO",$producto['ID']);
    $sentence->bindParam(":PRECIOUNITARIO",$producto['PRICE']);
    $sentence->bindParam(":CANTIDAD",$producto['CANTIDAD']);
    $sentence->execute();

    }

    // echo "<h3>".$total."</h3>";
    
    // 1 THERE IS A BUG IN "ID"
    // NULL IS NOT ACCEPTED AND NEED THE NUMBER BUT IS NOT AUTOMATIC

    // 2 THERE IS A BUG IN THE SECOND SENTENCE
    // DOES NOT SAVE THE DATA

}

?>

    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <style>
        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100%;
            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px;
            }
        }
    </style>

<div class="jumbotron">
    <h1 class="display-4">The last step...</h1>
    <hr class="my-4">
    <p class="lead">You are going to pay with Paypal</p>
        <h4>$ <?php echo number_format($total,2); ?></h4>

    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons().render('#paypal-button-container');
    </script>

    <p>The products will be available for download after payment</p>
    <strong>(Any doubts: luisjoselopezd@gmail.com)</strong>
</div>

<?php include 'templates/footer.php'; ?>
