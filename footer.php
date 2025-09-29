    </main>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <?php
                // Footer navigation
                if (has_nav_menu('footer')) {
                    ?>
                    <nav class="footer-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                        ));
                        ?>
                    </nav>
                    <?php
                }
                ?>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
