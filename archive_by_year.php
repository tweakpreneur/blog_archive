<?php 
/* archive by year */
function archivebyyear() {
global $wpdb;

  ob_start(); ?> 

<?php
/* $defaults = array(
        'numberposts'      => 5,
        'category'         => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => array(),
        'exclude'          => array(),
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'po
*/

$args = array(
'post_type'=> 'post',
'orderby'    => 'date',
'post_status' => 'publish',
'order'    => 'DESC',
'posts_per_page' => -1 // this will retrive all the post that is published 
);
$result = new WP_Query( $args );
$s_year = null; 

	if ( $result-> have_posts() ) : ?>
<table class="archive">
<?php while ( $result->have_posts() ) : $result->the_post(); ?>
<tr class="archiveyear"> 	
	<td>
	<?php
 $p_year = get_the_date( 'Y' ); 
    if ($p_year != $s_year){
        if ($s_year != null){?> 
		
		<?php } ?>
<h3><strong><?php echo $p_year; ?></strong></h3>	
	<?php } ?>
	</td>
	<td></td>
   	 </tr>	
<tr class="archivelist">
	<td class="date"> <?php echo get_the_date( 'j F' ); ?> </td>
	<td class="post">
		<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong> <span style="color:red"><i>(<?php the_category(', ') ?>)</i></span>
	</td>
</tr>
<?php $s_year = $p_year; ?>
<?php endwhile; ?>
</table>
	<?php endif; wp_reset_postdata(); ?>

  <?php	return ob_get_clean();
}
add_shortcode( 'myarchive', 'archivebyyear' );
?>
