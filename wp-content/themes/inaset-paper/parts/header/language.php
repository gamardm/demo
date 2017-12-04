<?php
$langs = inaset_get_langs( true );

if( empty( $langs ) ) {
	return;
}
?>
<li class="secondary-menu__language">
    <span class="select-language">
        <select class="js-open-link">
            <?php foreach( $langs as $lang ):
                if( $lang['slug'] == 'es' ) { continue; } ?>
                <option value="<?php echo esc_url( $lang['url'] ); ?>" <?php selected( $lang['current_lang'], 1 ); ?>><?php echo esc_html( strtoupper( $lang['slug'] ) ); ?></option>
            <?php endforeach; ?>
        </select>
    </span>
</li>
