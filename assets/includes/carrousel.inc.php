<div class="container-fluid home-message">
    <div id="myCarousel" class="carousel slide purple-gradient" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php
            $a_opts = explode("#", get_option("am_didyouknow"));
            $c_opts = 0;
            foreach ($a_opts as $opt){
            ?>
                <div class="carousel-item<?php echo ($c_opts == 0 ? " active" : "");  ?>">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1><?php _e("¿Sabías?");  ?></h1>
                            <p><?php echo $opt;  ?></p>
                        </div>
                    </div>
                </div>
            <?php
                $c_opts++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"><?php _e("Previous", "aipim");  ?></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"><?php _e("Next", "aipim");  ?></span>
        </a>
    </div>

</div>
