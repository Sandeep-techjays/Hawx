<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();

if (is_single() && 'post' == get_post_type()) { 
	$tite =  get_the_title(); ?>

	<div class="blogwithSidebar singlePage">

		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
		<div class="singleBlogImage <?php if (empty($image[0])) { ?>notHavingImage<?php } ?>">
			<div class="singleBlogImageInner">
				<?php if (has_post_thumbnail($post->ID)) : ?>
					<img src="<?php echo $image[0]; ?>" alt="Mosquitoes flying around" class="blogSingleImage">
				<?php endif; ?>
			</div>
			<div class="blogDetailsSection">
				<p class="blogTitle"><?php the_title(); ?></p>
				<p class="blogDate"><?php echo date('F d, Y', strtotime(get_the_date())); ?></p>
				<h2 class="blogAuthor">By Hawx Pest Control</h2>
				<div class="social-icons">
					<div class="addthis_inline_share_toolbox"></div>
				</div>
			</div>
		</div>

		<div class="blogNextPrevious">
			<div class="blogPrevPost">
				<?php previous_post_link('%link', 'prev post'); ?>
			</div>
			<div class="blogNextPost">
				<?php next_post_link('%link', 'next post'); ?>
			</div>
		</div>

		<div class="blogContentSection">
			<div class="contentInnerSec singleBlogSec">
				<?php the_content(); ?>
			</div>
			<div class="blogCategories">
				<h2>Categories</h2>
				<?php $categories = get_the_terms($post->ID, 'category'); ?>
				<ul class="cat-list dualCircle black">
					<?php foreach ($categories as $cat) {
						if (!empty($cat->name)) { ?>
							<li class="cat-item"><a href="/blog/categories/<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>

		<!-- CTA section -->

		<div class="cta-container">
			<div class="cta-content">
				<div class="cta-details">
					<div class="cta-heading">
						<p>Ready to protect your home or business from pests?</p>
					</div>
					<div class="cta-text">
						<p>Schedule today and get a service plan tailored to your property.
							Receive a detailed report with pictures after each service is completed.</p>
					</div>
					<a href='/contact-us/?blog_name=<?php echo $tite; ?>'> <button class="cta-button">Get free estimate</button></a>
				</div>
			</div>
		</div>

		<!--End of CTA section -->

		<div class="relatedBlogs">
			<p class="singleRelatedPost">RELATED POSTS</p>
			<?php
			$related_posts = get_posts(array('category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID)));
			if (!empty($related_posts)) { ?>
				<div class="blogRelatedcolumn">
					<?php foreach ($related_posts as $posts) { ?>
						<div class="blogArticlecolumnRelated">
							<?php $postDate = $posts->post_date; ?>
							<a href="<?php echo get_permalink($posts->ID) ?>">
								<div class="blogArticlecolumRelated">
									<div class="blogArticleRelatedcolumTop">
										<div class="blogRelatedDate"><?php echo date("M d", strtotime($postDate)); ?></div>
										<div class="blogRelatedTitle"><?php echo $posts->post_title; ?></div>
										<div class="blogRelatedExcerpt"><?php echo wp_trim_words(get_the_excerpt($posts->ID), 20, ' ...'); ?><?php //echo kumarpostexcerpt(20); 
																																				?></div>
									</div>
									<span class="blogViewRelatedArticle">View Article</span>
								</div>
							</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<?php if (astra_page_layout() == 'left-sidebar') : ?>
		<?php get_sidebar(); ?>
	<?php endif ?>
	<div id="primary" <?php astra_primary_class(); ?>>
		<?php astra_primary_content_top(); ?>
		<?php astra_content_loop(); ?>
		<?php astra_primary_content_bottom(); ?>
	</div><!-- #primary -->
	<?php if (astra_page_layout() == 'right-sidebar') : ?>
		<?php get_sidebar(); ?>
	<?php endif ?>
<?php } ?>
<?php get_footer(); ?>