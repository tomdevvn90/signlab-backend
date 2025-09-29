<?php
/**
 * The main template file
 *
 * @package SignLab_Blank
 */

get_header(); ?>

<div class="container">
    <div class="content-area">
        <?php if (have_posts()) : ?>
            
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <div class="posts-container">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                        
                        <?php if (has_post_thumbnail() && !is_single()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <header class="entry-header">
                            <?php
                            if (is_single()) {
                                the_title('<h1 class="entry-title">', '</h1>');
                            } else {
                                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                            }
                            ?>

                            <?php if ('post' === get_post_type()) : ?>
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="byline">
                                        by <?php the_author(); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </header>

                        <div class="entry-content">
                            <?php
                            if (is_single()) {
                                the_content();
                                
                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . __('Pages:', 'signlab-blank'),
                                    'after'  => '</div>',
                                ));
                            } else {
                                the_excerpt();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php _e('Read More', 'signlab-blank'); ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>

                        <?php if (is_single()) : ?>
                            <footer class="entry-footer">
                                <?php
                                $categories_list = get_the_category_list(', ');
                                $tags_list = get_the_tag_list('', ', ');
                                
                                if ($categories_list) {
                                    printf('<span class="cat-links">' . __('Posted in %1$s', 'signlab-blank') . '</span>', $categories_list);
                                }
                                
                                if ($tags_list) {
                                    printf('<span class="tags-links">' . __('Tagged %1$s', 'signlab-blank') . '</span>', $tags_list);
                                }
                                ?>
                            </footer>
                        <?php endif; ?>

                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'prev_text' => __('Previous', 'signlab-blank'),
                'next_text' => __('Next', 'signlab-blank'),
            ));
            ?>

        <?php else : ?>
            
            <div class="no-content">
                <header class="page-header">
                    <h1 class="page-title"><?php _e('Nothing Found', 'signlab-blank'); ?></h1>
                </header>

                <div class="page-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'signlab-blank'),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                        ),
                                    )
                                ),
                                esc_url(admin_url('post-new.php'))
                            );
                            ?>
                        </p>
                    <?php elseif (is_search()) : ?>
                        <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'signlab-blank'); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'signlab-blank'); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
