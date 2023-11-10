<div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products" id="accordian">
                               <?php   foreach ($categories as $category):     ?>                              
                          
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a class="<?php if($category['id']==$categoryId) echo 'active'?>" 
                                        href="/category/<?=$category['id']?>/page-1"><?=$category['name']?></a></h4>
                                    </div>
                                </div>

                                <?php endforeach?>
                               
                            </div>

                        </div>
                    </div>
