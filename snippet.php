  <A rel="nofollow" HREF="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fkibasa-21%2F8009%2Fd38eac67-19cb-48df-9b95-34ec74b4bd6d&Operation=NoScript">Amazon.de Widgets</A>
<!-- amazon widget homepage -->
  


<?php
/* Get Call to Action Buttons */
if (have_rows('buttons')):
    ?><div class="buttons">
    <?php while (have_rows('buttons')) : the_row(); ?>
            <a class="cta-button" href="<?php the_sub_field('link'); ?>" style="color:<?php the_sub_field('schriftfarbe'); ?>;background-color:<?php the_sub_field('hintergrundfarbe'); ?>">
                <?php the_sub_field('button-text'); ?>
            </a>
        <?php endwhile; ?>
    </div>
<?php endif; ?>