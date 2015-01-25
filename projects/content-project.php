<?php
/**
 * The template for displaying project content within loops.
 *
 * Override this template by copying it to yourtheme/projects/content-project.php
 *
 * @author      WooThemes
 * @package     Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Extra post classes
$classes = array();
$classes[] = 'col-sm-12';
$classes[] = 'col-md-4';

$excerpt_raw = '';
if ( isset( $post->post_excerpt ) ) {
    $excerpt_raw = $post->post_excerpt;
}
if ( '' === trim( $excerpt_raw ) ) {
    $excerpt_raw = get_the_excerpt();
} // End If Statement

?>

<div <?php post_class( $classes ); ?>>

    <div class="thumbnail projects-grid">

        <a href="<?php the_permalink(); ?>" class="project-permalink">

            <?php
                /**
                 * projects_loop_item hook
                 *
                 * @hooked projects_template_loop_project_thumbnail - 10
                 * @hooked projects_template_loop_project_title - 20
                 */
                 //do_action( 'projects_loop_item' );
                $img_url = wp_get_attachment_url( get_post_thumbnail_id() );
                if ( !$img_url ) {
                    echo "<div style='width:300;height:300px;'></div>";
                }
                else {
                    echo get_the_post_thumbnail($post->ID, "thumbnail", array("class"=>"rounded"));
                }
            ?>
        </a>
        <div class="caption">
            <h3><a href="<?php the_permalink(); ?>" class="project-permalink"><?php the_title(); ?></a></h3>
            <?php echo apply_filters( 'post_excerpt', wpautop( $excerpt_raw ) ) ?>
        </div>
    </div>

</div>
