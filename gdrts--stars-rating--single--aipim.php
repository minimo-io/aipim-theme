<?php // GDRTS Template: Display only for Aipim // ?>

<div class="<?php gdrts_loop()->render()->classes(); ?>">
    <div class="gdrts-inner-wrapper">

        <?php do_action('gdrts-template-rating-block-before'); ?>

        <?php

        do_action('gdrts-template-stars-rating-default-before-rating-stars');

        gdrts_loop()->render()->stars(Array(
            'allow_rating' => false
        ));

        do_action('gdrts-template-stars-rating-default-after-rating-stars');

        ?>

 

        <?php
        
        if (gdrts_loop()->is_save()) {

        ?>

            <?php if (apply_filters('gdrts-template-stars-rating-default-show-thank-you', true)) { ?>

                <div class="gdrts-rating-thanks">
                    <?php

                    do_action('gdrts-template-stars-rating-default-before-thank-you');

                    $thank_you = __("Thanks for your vote!", "gd-rating-system");

                    echo apply_filters('gdrts-template-stars-rating-default-thank-you-message', $thank_you);

                    do_action('gdrts-template-stars-rating-default-after-thank-you');

                    ?>
                </div>

            <?php } ?>

        <?php

        } else {
            if (apply_filters('gdrts-template-stars-rating-default-show-please-wait', true)) {
                do_action('gdrts-template-stars-rating-default-before-please-wait');

                gdrts_loop()->please_wait();

                do_action('gdrts-template-stars-rating-default-before-please-wait');
            }
        }

        gdrts_loop()->json();

        do_action('gdrts-template-rating-block-after');
        do_action('gdrts-template-rating-rich-snippet');

        ?>

    </div>
</div>
