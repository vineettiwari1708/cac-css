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



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////





// Enqueue Bebas Neue font
function enqueue_bebas_font() {
    wp_enqueue_style( 'bebas-neue', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'enqueue_bebas_font' );

// Custom Astra logo
add_filter( 'astra_logo', 'custom_override_astra_logo', 10, 3 );

function custom_override_astra_logo( $html, $display_site_title, $display_site_tagline ) {
    ob_start(); ?>

    <style>
        .craze-logo-text {
            font-family: 'Bebas Neue', sans-serif;
            display: inline-block;
          background:white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .craze-logo-green {
            color: #33ff33;
        }
        .craze-subtitle {
            font-size: 12px;
            color: white;
        }
    </style>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link" rel="home" style="display: flex; align-items: center; gap: 10px;">
        <img src="http://localhost/understrap/wp-content/uploads/2025/09/logo-light.png" alt="Craze Auto Care Logo" width="40" height="40" style="vertical-align: middle;" />
        <span style="display: inline-block; font-family: 'Bebas Neue', sans-serif;">
            <span class="craze-logo-text">CRAZE </span>
            <span class="craze-logo-green">AUTO</span>
            <span class="craze-logo-text"> CARE</span><br>
            <span class="craze-subtitle">DOOR STEP SERVICE</span>
        </span>
    </a>

    <?php
    return ob_get_clean();
}

