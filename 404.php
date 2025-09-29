<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package SignLab_Blank
 */

get_header(); ?>

<div class="container">
    <div class="content-area">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'signlab-blank'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'signlab-blank'); ?></p>

                <?php get_search_form(); ?>

                <div class="error-suggestions">
                    <h2><?php _e('Popular Pages', 'signlab-blank'); ?></h2>
                    <?php
                    wp_list_pages(array(
                        'title_li' => '',
                        'number' => 5,
                    ));
                    ?>

                    <h2><?php _e('Recent Posts', 'signlab-blank'); ?></h2>
                    <ul>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                        ));
                        foreach ($recent_posts as $post) {
                            echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>
