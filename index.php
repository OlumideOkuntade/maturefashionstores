<?php
    require_once("partials/header.php");
    require_once "admin/classes/Admin.php";
    $admin = new Admin;
    $prod = $admin->allProduct();

?>
<style>
    
</style>

<!-- end navigation -->
<div class="row mb-5">
    <div class="col-md-12" >
        <div class="header_container">
            <div class ="overlay">
                <div>
                    <h1 >Refined Fashion.</h1>
                    <h1>Unmatched Style.</h1>
                    <button class=" fw-bold btn btn-light btn-lg rounded-5 mt-3 ">Shop Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- select -->
<div class="row view_container ms-5 mb-3 me-5">
    <section id="arrivals">  
        <div class="col-md-12 view_container-first mb-3">
            <h3>New Arrivals</h3>
        </div>
        <div class="col-md-12 view_container-second" >
            <div>
                <a href="#">Men</a>
            </div>
            <button class="btn btn-dark btn-sm rounded-3 ">View All</button>
        </div>
    </section>
</div>
<!-- start card -->
<div class="row ms-5 me-5 card_container" id="all">
        <?php 
            foreach($prod as $p){
        ?>        
            <div class="col-md-4 mb-3 ">
                <div class="card" >
                    <img src="admin/uploads/<?php echo $p['product_image'] ?>" class="img-fluid rounded" style="width:500px; height:400px;" alt="responsive image">
                    <div class="card-body ">
                        <p class="fs-6 fw-bold lh-1"><?php echo $p['product_name']?></p>
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="fs-4 fw-bold lh-1 ">&#8358;<?php echo $p['product_price']?></p>
                            <button class="btn btn-success round "><a href="#">Quick Buy</a></button>  
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    
   
</div>


        
<?php
    require_once("partials/footer.php");

?>

        