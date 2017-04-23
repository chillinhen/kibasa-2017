<center>
<p>
        <a href="<?php echo $shop_page; ?>" class="button"><?php echo _e( 'Dein Shop', 'wcvendors' ); ?></a>
        <a href="<?php echo $settings_page; ?>" class="button"><?php echo _e( 'Einstellungen', 'wcvendors' ); ?></a>

<?php if ( $can_submit ) { ?>
                <a target="_TOP" href="<?php echo $submit_link; ?>" class="button"><?php echo _e( 'Produkt hinzufügen', 'wcvendors' ); ?></a>
                <a target="_TOP" href="<?php echo $edit_link; ?>" class="button"><?php echo _e( 'Produkte bearbeiten', 'wcvendors' ); ?></a>
<?php } ?>
</center>

<hr>