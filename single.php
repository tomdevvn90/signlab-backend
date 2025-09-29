<?php
/**
 * The template for displaying all single posts
 *
 * @package SignLab_Blank
 */

get_header(); ?>

<div class="container">
    <div class="content-area">
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    
                    <div class="entry-meta">
                        <span class="posted-on">
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="byline">
                            by <?php the_author(); ?>
                        </span>
                        <?php
                        $categories_list = get_the_category_list(', ');
                        if ($categories_list) {
                            echo '<span class="cat-links"> in ' . $categories_list . '</span>';
                        }
                        ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'signlab-blank'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) {
                        echo '<div class="tags-links">' . __('Tagged: ', 'signlab-blank') . $tags_list . '</div>';
                    }
                    ?>
                </footer>

            </article>

            <?php
            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'signlab-blank') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . __('Next:', 'signlab-blank') . '</span> <span class="nav-title">%title</span>',
            ));
            ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
