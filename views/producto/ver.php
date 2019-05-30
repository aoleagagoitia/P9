<?php if (isset($product)): ?>
    <h1><?= $product->nombre ?></h1>

    <div id="detail-product">
        <div class="image">
            <?php if ($product->imagen != null): ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>"/>
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/no_imagen.png"/>
            <?php endif; ?>
        </div>

        <div class="data">
            <p class="description"><?= $product->descripcion ?></p>
            <p class="price"><?= $product->precio ?>€</p>
            <a href="" class="button">Comprar</a>
        </div>
        <!-- VALORACIONES --> 
        <div class="data">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-center">
                        <h1 class="rating-num">
                            <?php
                            if ($media != null) {
                                //echo $media;
                                echo "Valoración";
                            } else {
                                //echo "0";
                                echo "Valoración";
                            }
                            ?>
                        </h1>
                        <div class="rating">
                            <?php 
                            $cont = 0; 
                            for ($i = 0; $i < $media; $i++) {
                                $cont++;
                                ?>
                                <span class="glyphicon glyphicon-star"></span>
                            <?php } for ($i = 0; $i < (5-$cont); $i++) {?>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <?php } ?>
                        </div>
                        <!--<div>-->
                            <!-- Total de valoraciones -->
                            <!--<span class="glyphicon glyphicon-user"></span>1,050,008 total-->
                        <!--</div>-->
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="row rating-desc">
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>5
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100" style="width: <?=$quinta?>%">
                                        <span class="sr-only"><?=$quinta?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 5 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>4
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100" style="width: <?=$cuarta?>%">
                                        <span class="sr-only"><?=$cuarta?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 4 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>3
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100" style="width: <?=$tercera?>%">
                                        <span class="sr-only"><?=$tercera?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 3 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>2
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100" style="width:  <?=$segunda?>%">
                                        <span class="sr-only"><?=$segunda?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 2 -->
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>1
                            </div>
                            <div class="col-xs-8 col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                         aria-valuemin="0" aria-valuemax="100" style="width: <?=$primera?>%">
                                        <span class="sr-only"> <?=$primera?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 1 -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN VALORACIONES --> 
    </div>









    <div class="valoraciones">
        <h2 class="text-center">Opiniones</h2>

        <?php
        foreach ($valoraciones as $valoracion) {

            if ($valoracion['aprobada'] === "1") {
                ?>

                <div class="carta">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                <p class="text-secondary text-center"><?= $valoracion['fecha'] ?></p>
                            </div>
                            <div class="col-md-10">
                                <p>
                                <p class="float-left"><strong><?= $valoracion['nombre'] ?></strong></p>
                                <?php for ($i = 0; $i < $valoracion['estrellas']; $i++) { ?>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
            <?php } ?>
                                </p>
                                <div class="clearfix"></div>
                                <p><?= $valoracion['comentario'] ?></p>

                                    <?php if (isset($_SESSION['identity']) && $_SESSION['identity']->rol === "admin") { ?>
                                    <p  id="aprobadas<?= $valoracion['id'] ?>" >
                <?php if ($valoracion['aprobada'] === "1") { ?>


                                        <div class="alert alert-success" role="alert">
                                            Aprobada
                                            <span class="float-right glyphicon glyphicon-ok alert-success" aria-hidden="true"></span> 
                                        </div>

                <?php } else { ?>
                                        <a class="float-right btn btn-outline-primary ml-2 rechazarValoracion" id="idRechazo<?= $valoracion['id'] ?>"> Rechazar</a>
                                        <a class="float-right btn text-white btn-danger aprobarValoracion" id="idAprobar<?= $valoracion['id'] ?>"> Aprobar</a>
                                    <?php } ?>
                                    </p>
            <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>
            <?php } else if (isset($_SESSION['identity'])  && $_SESSION['identity']->rol === "admin") {
                ?>
                <div class="carta" id="carta<?= $valoracion['id'] ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                <p class="text-secondary text-center"><?= $valoracion['fecha'] ?></p>
                            </div>
                            <div class="col-md-10">
                                <p>

                                <p class="float-left userIdValoration" id="userId<?= $valoracion['usuario_id'] ?>"><strong><?= $valoracion['nombre'] ?></strong></p>
                                <?php for ($i = 0; $i < $valoracion['estrellas']; $i++) { ?>
                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
            <?php } ?>
                                </p>
                                <div class="clearfix"></div>
                                <p><?= $valoracion['comentario'] ?></p>

                                <p  id="aprobadas<?= $valoracion['id'] ?>" >
            <?php if ($valoracion['aprobada'] === "1") { ?>


                                    <div class="alert alert-success" role="alert">
                                        Aprobada
                                        <span class="float-right glyphicon glyphicon-ok alert-success" aria-hidden="true"></span> 
                                    </div>

            <?php } else { ?>
                                    <a class="float-right btn btn-outline-primary ml-2 rechazarValoracion" id="idRechazo<?= $valoracion['id'] ?>"> Rechazar</a>
                                    <a class="float-right btn text-white btn-danger aprobarValoracion" id="idAprobar<?= $valoracion['id'] ?>"> Aprobar</a>
            <?php } ?>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        if (isset($_SESSION['identity']) && $_SESSION['identity']->rol != "admin") {
            ?>
            <div class="container">
                <div class="row" style="margin-top:70px;">
                    <div class="col-md-6">
                        <div class="well well-sm">
                            <div class="text-right">
                                <a class="btn btn-success btn-green linkDesactivado" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                            </div>

                            <div class="row" id="post-review-box" style="display:none;">
                                <div class="col-md-12">
        
                                    <form accept-charset="UTF-8" action="<?= base_url ?>usuario/valorar" method="post">
                                        <input id="ratings-hidden" name="rating" type="hidden"> 
                                        <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                        <input type="hidden" name="user_id" value="<?= $_SESSION['identity']->id ?>"/>
                                        <input type="hidden" name="product_id" value="<?= $product->id ?>"/>
                                        <div class="text-right">
                                            <div class="stars starrr" data-rating="0"></div>
                                            <a class="btn btn-danger btn-sm linkDesactivado" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                                <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                            <button class="btn btn-success btn-lg" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 

                    </div>
                </div>
            </div>
    <?php } ?>
    </div>


<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>
