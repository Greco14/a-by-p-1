<?php 
/**
 * footer.php
 *
 * Footer 
 */
?>
    <?php if( is_front_page() ) : ?>
    
    <div id="logoAn"></div>

    <?php endif; ?>

    <div class="footer">
        <div class="socialHold">
            <a href="https://www.facebook.com/approvedbypablo" target="_blank"><div class="btnIn"><p>Facebook</p></div></a>
            <a href="https://twitter.com/ApprovedbyPablo" target="_blank"><div class="btnIn"><p>Twitter</p></div></a>
            <a href="http://instagram.com/approvedbypablo" target="_blank"><div class="btnIn"><p>Instragram</p></div></a>
        </div>
        <div class="clearfix"></div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>