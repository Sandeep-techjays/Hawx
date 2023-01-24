<?php 
/* Template Name: Blog Page */
get_header(); ?>

<div class="blogwithSidebar">
    <div class="blogBreadcrumb">
        <div class="blogBreadcrumbCointainer">
            <a href="/" class="blogBreadcrumbHome">
                <svg viewBox="0 0 36 36" alt="Home Icon" role="presentation" data-use="/cms/svg/site/nst3xcjc347.36.svg#home">
                    <path d="M35.815 19.997l-17.325-17.966a0.655 0.655 0 0 0-0.479-0.205h0a0.665 0.665 0 0 0-0.491 0.201l-17.325 17.972a0.671 0.671 0 0 0 0.012 0.951a0.706 0.706 0 0 0 0.491 0.181a0.67 0.67 0 0 0 0.467-0.202l2.253-2.336V33.504a0.682 0.682 0 0 0 0.683 0.673h9.501a0.671 0.671 0 0 0 0.671-0.673V23.05h7.453v10.456a0.682 0.682 0 0 0 0.683 0.673h9.501a0.682 0.682 0 0 0 0.683-0.673V18.592l2.241 2.33a0.694 0.694 0 0 0 0.479 0.207h0.012a0.669 0.669 0 0 0 0.491-1.132h0Zm-13.407 1.706h-8.806a0.67 0.67 0 0 0-0.671 0.67v10.46h-8.159V17.187l13.228-13.731l13.24 13.731V32.833h-8.159v-10.46a0.671 0.671 0 0 0-0.671-0.67h0Z"></path>
                </svg>
            </a>
            <a class="blogNav">Blog</a>
        </div>
    </div>

    <div class="blogMainContainer">
        <div class="blogLeftSection">
            <div class="sidebarCategories most-popular">
                <p class="blogSidebarHead">MOST POPULAR</p>
                <?php 
                $popular_posts_args = array(
                    'post_type'=> 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 5,
                    'meta_key' => 'hawx_post_viewed',
                    'orderby' => 'meta_value_num',
                    'order'=> 'DESC'
                );
                $popular_posts_loop = new WP_Query( $popular_posts_args );
                if ( $popular_posts_loop-> have_posts() ) :
                while( $popular_posts_loop->have_posts() ) : $popular_posts_loop->the_post();
                    echo '<div class="sidebarCategoryName"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                    //echo get_the_title();
                endwhile;
                endif;
                wp_reset_query(); ?>
            </div>
            <div class="sidebarCategories">
                <p class="blogSidebarHead">CATEGORIES</p>
                <?php 
                $args = array(
                    'orderby' => 'id',
                    'hide_empty'=> 0, 
                    'exclude'=>array(1),
                );
                $categories = get_categories($args);
                foreach($categories as $category) {
                    echo '<div class="sidebarCategoryName"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></div>';
                } ?>
            </div>
        </div>
        <div class="blogRightSection">
            <p class="blogRecentNews">Recent News</p>
            <?php
                $args = array(
                    'post_type'=> 'post',
                    'post_status' => 'publish',
                    'order'    => 'DESC',
                    'posts_per_page' => -1 // this will retrive all the post that is published 
                );
                $result = new WP_Query( $args );
                if ( $result-> have_posts() ) : ?>
                    <div class="blogMaincolumn">
                    <?php while ( $result->have_posts() ) : $result->the_post(); ?>
                        <div class="blogArticlecolumn">
                            <a href="<?php echo get_permalink() ?>">
                            <div class="blogArticlecolum">
                                <div class="blogArticlecolumTop">
                                    <div class="blogDate"><?php echo get_the_date( 'M d' ); ?></div>
                                    <div class="blogTitle"><?php echo get_the_title(); ?></div>
                                    <div class="blogExcerpt"><?php echo kumarpostexcerpt(20); ?></div>
                                </div>
                                <span class="blogViewArticle">View Article</span>                                
                            </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; 
                wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>