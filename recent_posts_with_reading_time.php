	<?php

//estimated reading time
function reading_time() {
$content = get_post_field( 'post_content', $post->ID );
$word_count = str_word_count( strip_tags( $content ) );
$readingtime = ceil($word_count / 250);

if ($readingtime == 1) {
$timer = " min";
} else {
$timer = " mins";
}
$totalreadingtime = $readingtime . $timer;

return $totalreadingtime;
}


/* recent articles for homepage */
function recent_articles() {
global $wpdb;

  ob_start(); ?> 

<?php

		$args = array(
		'post_type'      => 'post',
        'post_status' => 'publish',
		//'orderby'        => 'date',
		//'order'          => 'ASC',
		'posts_per_page' => 5,
	    'meta_query' => array(
	        array(
	            //'key'   => 'is_featured',
	            //'value' => 'true'
	        	)
	    	)				
		);

		// The Query
		$the_query = new WP_Query( $args );

		$i = 1;

		if ( $the_query->have_posts() ) :	

	?>

		<div id="recent-content" class="content-loop">
	 			
				<div class="section-header clear">
					<h3>
						<?php echo __('From the blog', 'starter'); ?>
					</h3>
				</div><!-- .section-header -->

		<?php
			// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
		?>	

<!--<div id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>-->	

	<div class="hentry entry-overview <?php if( $i % 5 == 0) { echo "last"; }?>">

		
		<?php if ( has_post_thumbnail() ) { ?>
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">
				<div class="thumbnail-wrap">
					<?php 
						the_post_thumbnail(); 
					?>
				</div><!-- .thumbnail-wrap -->
			</a>
		<?php } ?>	
	
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<div class="entry-meta entry-home">

<span class="entry-author"><?php echo get_avatar( get_the_author_meta('user_email') , 48 ); ?> <?php the_author_posts_link(); ?></span> <span class="entry-date"> <span class="dashicons dashicons-calendar-alt"></span> <?php echo get_the_date(); ?></span> <!--<span class="entry-category"> <span class="dashicons dashicons-category"></span><?php the_category(', ') ?> </span>--> <span class='entry-rtime'> <span class="dashicons dashicons-clock"></span> <?php echo reading_time(); ?> read </span>


<!--<span class="entry-author"><?php the_author_posts_link(); ?> / </span> <span class="entry-date"><?php echo get_the_date(); ?> / </span> <span class="entry-category"><?php starter_first_category(); ?> <?php //the_category(', ') ?> / </span> <span class='entry-rtime'> <?php echo reading_time(); ?> read </span>-->
		
		</div><!-- .entry-meta -->

		<div class="entry-summary">
			<?php the_excerpt(); ?> &nbsp; <br />
			<span class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'starter'); ?> &raquo;</a></span>
			
			<!--<span><?php comments_popup_link( '0 comment', '1 comment', '% comments', 'comments-link', 'comments off');?></span>-->
		</div><!-- .entry-summary -->

	</div><!-- .entry-overview -->
		
		<?php   
			$i++;
			endwhile;
		?>

		</div><!-- #featured-content -->

	<?php
		endif;
		wp_reset_postdata();
	?>		
  <?php	return ob_get_clean();
}
add_shortcode( 'rarticles', 'recent_articles' );

	?>		
