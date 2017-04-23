<?php
//
$eventText = get_field('event_text','option');
$linkText = get_field('linktext','option');
$post_object = get_field('link','option');
?>
<?php if ($eventText) : ?>
    <div class="badge">
        <h2>
            <?php echo $eventText; ?>
            <?php
            if ($post_object):
                $post = $post_object;
                setup_postdata($post);
                ?>

                <a href="<?php the_permalink(); ?>"><span><?php echo $linkText; ?></span></a>
        <?php wp_reset_postdata();
    endif; ?>
        </h2>
    </div>
<?php endif; ?>