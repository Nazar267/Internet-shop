<?php include_once(ROOT.'/views/layouts/header.php');?>

        <section>
           
           <?php include_once(ROOT.'/views/layouts/category.php');  ?>

                    <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="/template/images/product-details/1.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2><?=$product['name']?></h2>
                                        <p>Код товару: <?=$product['code']?></p>
                                        <span>
                                            <span><?=$product['price']?>$</span>
                                            <label>Кількість</label>
                                            <input type="text" value="3" />
                                            <button type="button" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </button>
                                        </span>
                                        <p><b>Наличие:</b><?php if($product['availability']) echo'На складі'; else echo'Товар відсутній' ?></p>
                                        <p><b>Состояние:</b> <?php  if($product['is_new']) echo'Новий'; else echo 'Б/У' ?></p>
                                        <p><b>Производитель:</b><?=$product['brand']?></p>
                                    </div><!--/product-information-->
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-sm-12">
                                    <h5>Опис товару</h5>
                                    <p><?=$product['description']?></p>
                                 
                                </div>
                            </div>
                        </div><!--/product-details-->

                    </div>
                </div>
            </div>
        </section>
        

        <br/>
        <br/>
        
     


<?php include_once(ROOT.'/views/layouts/footer.php');  ?>
   
