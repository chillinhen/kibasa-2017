<?php
/* Get Call to Action Buttons */
if (have_rows('buttons','option')):
    ?><div class="buttons">
    <?php while (have_rows('buttons','option')) : the_row(); ?>
            <a class="cta-button" href="<?php the_sub_field('link'); ?>" style="color:<?php the_sub_field('schriftfarbe'); ?>;background-color:<?php the_sub_field('hintergrundfarbe'); ?>">
                <?php the_sub_field('button-text'); ?>
            </a>
        <?php endwhile; ?>
    </div>
<?php endif; ?>