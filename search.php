<?php
/**
 * The template for displaying search results pages
 *
 * @package SignLab_Blank
 */

get_header(); ?>

<div class="container">
    <div class="content-area">
        
        <?php if (have_posts()) : ?>
            
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'signlab-blank'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <div class="search-results">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="search-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="search-content">
                            <header class="entry-header">
                                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="post-type">
                                        <?php echo get_post_type(); ?>
                                    </span>
                                </div>
                            </header>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>

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
            
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('Nothing found for: %s', 'signlab-blank'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <div class="page-content">
                <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'signlab-blank'); ?></p>
                
                <?php get_search_form(); ?>
                
                <div class="search-suggestions">
                    <h2><?php _e('Popular Pages', 'signlab-blank'); ?></h2>
                    <?php
                    wp_list_pages(array(
                        'title_li' => '',
                        'number' => 5,
                    ));
                    ?>
                </div>
            </div>

        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>
