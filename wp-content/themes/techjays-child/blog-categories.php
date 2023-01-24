<?php 
/* Template Name: Blog Categories */
get_header(); ?>

<div class="blogwithSidebar">
    <div class="blogBreadcrumb">
        <div class="blogBreadcrumbCointainer">
            <a href="/" class="blogBreadcrumbHome">
                <svg viewBox="0 0 36 36" alt="Home Icon" role="presentation" data-use="/cms/svg/site/nst3xcjc347.36.svg#home">
                    <path d="M35.815 19.997l-17.325-17.966a0.655 0.655 0 0 0-0.479-0.205h0a0.665 0.665 0 0 0-0.491 0.201l-17.325 17.972a0.671 0.671 0 0 0 0.012 0.951a0.706 0.706 0 0 0 0.491 0.181a0.67 0.67 0 0 0 0.467-0.202l2.253-2.336V33.504a0.682 0.682 0 0 0 0.683 0.673h9.501a0.671 0.671 0 0 0 0.671-0.673V23.05h7.453v10.456a0.682 0.682 0 0 0 0.683 0.673h9.501a0.682 0.682 0 0 0 0.683-0.673V18.592l2.241 2.33a0.694 0.694 0 0 0 0.479 0.207h0.012a0.669 0.669 0 0 0 0.491-1.132h0Zm-13.407 1.706h-8.806a0.67 0.67 0 0 0-0.671 0.67v10.46h-8.159V17.187l13.228-13.731l13.24 13.731V32.833h-8.159v-10.46a0.671 0.671 0 0 0-0.671-0.67h0Z"></path>
                </svg>
            </a>
            <a href="/blog/" class="blogNav">Blog</a>
            <a class="blogNav catName">Categories</a>
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
            <p class="blogRecentNews">POSTS BY CATEGORY</p>
            <svg class="svgTwoLinLeft1 desktopsvg" role="presentation" data-use="/includes/flair.svg#header" viewBox="0 0 204 11" style="width: 0px;">
                <g class="center">
                    <path class="line" d="M103,10.5h-62" style="stroke-dashoffset: 62; stroke-dasharray: 62;"></path>
                    <path class="line" d="M101,10.5h62" style="stroke-dashoffset: 62; stroke-dasharray: 62;"></path>
                    <path class="line" d="M101,2h102" style="stroke-width: 3px; stroke-dashoffset: 102; stroke-dasharray: 102;"></path>
                    <path class="line" d="M103,2h-102" style="stroke-width: 3px; stroke-dashoffset: 102; stroke-dasharray: 102;"></path>
                </g>
                <g class="left">
                    <path class="line" d="M0,10.5h124" style="stroke-dashoffset: 124; stroke-dasharray: 124;"></path>
                    <path class="line" d="M0,2h204" style="stroke-width: 3px; stroke-dashoffset: 204; stroke-dasharray: 204;"></path>
                </g>
                <g class="right">
                    <path class="line" d="M204,10.5h-124" style="stroke-dashoffset: 124; stroke-dasharray: 124;"></path>
                    <path class="line" d="M204,2h-204" style="stroke-width: 3px; stroke-dashoffset: 204; stroke-dasharray: 204;"></path>
                </g>
            </svg>
            <svg class="svgTwoLinCenter1 mobilesvg" role="presentation" data-use="/includes/flair.svg#header" viewBox="0 0 204 11" style="width: 0px;">
                <g class="center">
                    <path class="line" d="M103,10.5h-62" style="stroke-dashoffset: 62; stroke-dasharray: 62;"></path>
                    <path class="line" d="M101,10.5h62" style="stroke-dashoffset: 62; stroke-dasharray: 62;"></path>
                    <path class="line" d="M101,2h102" style="stroke-width: 3px; stroke-dashoffset: 102; stroke-dasharray: 102;"></path>
                    <path class="line" d="M103,2h-102" style="stroke-width: 3px; stroke-dashoffset: 102; stroke-dasharray: 102;"></path>
                </g>
                <g class="left">
                    <path class="line" d="M0,10.5h124" style="stroke-dashoffset: 124; stroke-dasharray: 124;"></path>
                    <path class="line" d="M0,2h204" style="stroke-width: 3px; stroke-dashoffset: 204; stroke-dasharray: 204;"></path>
                </g>
                <g class="right">
                    <path class="line" d="M204,10.5h-124" style="stroke-dashoffset: 124; stroke-dasharray: 124;"></path>
                    <path class="line" d="M204,2h-204" style="stroke-width: 3px; stroke-dashoffset: 204; stroke-dasharray: 204;"></path>
                </g>
            </svg>
            <?php
                $args = array(
                    'orderby' => 'id',
                    'hide_empty'=> 0, 
                    'exclude'=>array(1),
                );
                $categories = get_categories($categories); ?>
                <div class="blogMaincolumn">
                <?php foreach($categories as $category) { ?>
                    <div class="blogArticlecolumcat">
                        <?php 
                        $categorys = get_category($category->term_id);
                        $count = $categorys->category_count;
                        echo '<div class="CategoryName"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '(' . $count . ')' . '</a></div>'; ?>
                    </div>                                    
                <?php } ?>
                </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>