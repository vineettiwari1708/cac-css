// Enqueue custom font (Bebas Neue)
function enqueue_bebas_font() {
    wp_enqueue_style( 'bebas-neue', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'enqueue_bebas_font' );

// Override Astra logo output
add_filter( 'astra_logo', 'custom_override_astra_logo', 10, 3 );

function custom_override_astra_logo( $html, $display_site_title, $display_site_tagline ) {
    ob_start(); ?>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link" rel="home" style="display: flex; align-items: center; gap: 10px;">
        <img src="http://localhost/understrap/wp-content/uploads/2025/09/logo-light.png" alt="Craze Auto Care Logo" width="40" height="40" style="vertical-align: middle;" />
        <span style="display:inline-block; color:white; font-family: 'Bebas Neue', sans-serif;">
            CRAZE <span style="color:#33ff33;">AUTO</span> CARE<br>
            <span style="font-size: 12px;">DOOR STEP SERVICE</span>
        </span>
    </a>

    <?php
    return ob_get_clean();
}
