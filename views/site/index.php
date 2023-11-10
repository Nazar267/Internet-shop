<?php include_once(ROOT.'/views/layouts/header.php'); ?>

        <section>
          
        <?php  include_once(ROOT.'/views/layouts/category.php');?>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Последние товары</h2>
                          
                         <?php  foreach ($latestProducts as $product) :  ?>

                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/template/images/home/product4.jpg" alt="" />
                                            <h2><?=$product['price']?>$</h2>
                                            <p> <a href="/product/<?=$product['id']?>"> <?=$product['name']?> </a> </p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                        </div>
                                        <?php if($product['is_new']) :?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                           <?php endforeach  ?>

                        </div><!--features_items-->

                        <div class="recommended_items"><!--recommended_items-->
                            <h2 class="title text-center">Рекомендуемые товары</h2>

                            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">	

                                     <?php $i=0;
                                     for (; $i < count($recommendedProducts); $i++):                                  
                                                                     
                                     ?>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="/template/images/home/recommend1.jpg" alt="" />
                                                        <h2>$ <?=$recommendedProducts[$i]['price']?></h2>
                                                        <p><?=$recommendedProducts[$i]['name']?></p>
                                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php endfor;?>
                                    </div>
                                    <div class="item">	
                                  
                                    </div>
                                </div>
                                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>			
                            </div>
                        </div><!--/recommended_items-->

                    </div>
                </div>
            </div>
        </section>

      <?php include_once(ROOT.'/views/layouts/footer.php') ?> 