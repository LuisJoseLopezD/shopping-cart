<?php 

include 'global/config.php';
include 'global/connect.php';
include 'shopping_cart.php';
include 'templates/header.php';

?>

        <br>
        <!-- if message is empty -->
        <?php if($message!="") { ?> 

        <div class="alert alert-success">
            <?php echo $message; ?> 
            <a class="badge badge-success" href="showCart.php">see my products</a>
        </div>
    </div>

        <?php } ?>

    <div class="row">

    <?php 
    
        $sentence = $pdo->prepare("SELECT * FROM tblproductos");
        $sentence->execute(); // execute the sentence

        $productList = $sentence->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // echo print_r($productList);
        // echo "</pre>";

    ?>

    <!-- product container -->
    <?php foreach($productList as $product){ ?>

        <div class="col-4">
            <div class="card">
                <img 
                title="<?php echo $product['name'];?>" 
                alt="<?php echo $product['name'];?>"
                class="card-img-top"
                src="<?php echo $product['image'];?>"

                data-toggle="popover"
                data-trigger="hover"
                data-content="<?php echo $product['description'];?>"
                
                >

                <div class="card-body">
                    <span><?php echo $product['name']; ?></span>
                    <h5 class="card-title">$ <?php echo $product['price'];?></h5>
                    <p class="card-text">description</p>

                    <form action="" method="post">

                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($product['id'],COD,KEY);?>">
                        
                        <input type="hidden" name="name" id="name" value="<?php echo openssl_encrypt($product['name'],COD,KEY);?>">
                        
                        <input type="hidden" name="price" id="price" value="<?php echo openssl_encrypt($product['price'],COD,KEY);?>">
                        
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                        <button 
                            class="btn btn-primary"
                            name="btn-action" 
                            value="add" 
                            type="submit">add to car
                        </button>
                    </form>

                </div>
            </div>
        </div>

    <?php } ?>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>    

<?php include 'templates/footer.php'; ?>