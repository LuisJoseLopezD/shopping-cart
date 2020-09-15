<?php 

include 'global/config.php';
include 'shopping_cart.php';
include 'templates/header.php';

?>

<br>

<h3>products list</h3>

<?php if(!empty($_SESSION['CARRITO'])) { ?>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th width="40%">description</th>
            <th width="15%" class="text-center">quantity</th>
            <th width="20%" class="text-center">price</th>
            <th width="20%" class="text-center">total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){?>

        <tr>
            <td width="40%"><?php echo $producto['NAME']; ?></td>
            <td width="15%" class="text-center"><?php echo $producto['CANTIDAD']; ?></td>
            <td width="20%" class="text-center"><?php echo $producto['PRICE']; ?></td>
            <td width="20%" class="text-center"><?php echo number_format($producto['PRICE']*$producto['CANTIDAD'],2); ?></td>
            <td width="5%"> 
            
            <form method="post" action="">

                <input 
                type="hidden"
                name="id"
                id="id" 
                value="<?php echo openssl_encrypt($producto['id'],COD,KEY); ?>"> 

                <button 
                class="btn btn-danger"
                type="submit"
                name="btn-action"
                value="delete">Delete</button> 
            
            </form>

            </td>
        </tr>
        <?php $total = $total+($producto['PRICE']*$producto['CANTIDAD']); ?>
        <?php } ?>
        
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td class="text-center"><h3>$ <?php echo number_format($total,2); ?></h3></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="5">

                <form action="pay.php" method="post">
                
                    <div class="alert alert-success">
                        <div class="form-group">

                            <label for="my-input">Email: </label>
                            <input id="email" name="email"
                            class="form-control" 
                            type="email"
                            placeholder="please type email"
                            required>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">
                            you will receive your products in this email
                        </small>
                    </div>  

                    <button 
                    class="btn btn-primary btn-lg btn-block" 
                    type="submit" 
                    name="btn-action"
                    value="proceder">
                    go to pay >>>
                    </button>  
                
                </form>    
            </td>
        </tr>

    </tbody>
</table>

<?php }else { ?>

<div class="alert alert-success">
    No products...
</div>

<?php } ?>

<?php include 'templates/footer.php'; ?>