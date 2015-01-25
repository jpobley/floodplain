<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$images = array();
$feature = wp_get_attachment_url( get_post_thumbnail_id() );
if ($feature) {
    $images[] = $feature;
}
foreach (projects_get_gallery_attachment_ids() as $id) {
    $url = wp_get_attachment_url($id);
    if (!$url)
        continue;
    $images[] = $url;
}

$haveImages = count($images) > 0;
if($haveImages) {
    floodplain_load_flexslider();
}

$deets = array(
    "client"   => esc_attr( get_post_meta( $post->ID, '_client', true ) ),
    "url"      => esc_url( get_post_meta( $post->ID, '_url', true ) ),
    "location" => esc_attr( get_post_meta( $post->ID, '_location', true ) ),
    "date"     => esc_attr( get_post_meta( $post->ID, '_date', true ) )
);
$client_info = array_filter(array($deets["client"], $deets["date"]), 'strlen' );
?>
<div id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="col-xs-12">
        <h1 class="project-title">
            <?php the_title(); ?>
            <?php if (count($deets) > 0 ): ?>
                <br>
                <small>
                    <?php
                    if (count($client_info) > 0) { echo implode(", ", $client_info); }
                    ?>
                </small>
            <?php endif; ?>
        </h1>
    </div>

    <?php if ( $post->post_excerpt ): ?>
    <div class="col-xs-12 single-project-short-description" itemprop="description">
            <?php echo apply_filters( 'post_excerpt', wpautop( $post->post_excerpt ) ) ?>
    </div>
    <?php endif; ?>

    <?php if (count($images) > 0): ?>
    <div class="col-xs-12 col-md-6">
        <div style="max-width:600px;">
            <div class="flexslider">
              <ul class="slides">
                <?php foreach ($images as $src): ?>
                    <li>
                        <img class="rounded" src=<?php echo "'" . $src . "'" ?>/>
                    </li>
                <?php endforeach; ?>
              </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($post->post_content): ?>
    <div class="col-xs-12 col-md-6">
        <div class="project-description">
            <?php echo apply_filters( 'projects_description', the_content() ); ?>
        </div>
    </div>
    <?php endif; ?>
</div><!-- #project-<?php the_ID(); ?> -->

<nav class="projects-single-pagination">
    <div class="next">
        <?php next_post_link( '%link' ); ?>
    </div>
    <div class="previous">
        <?php previous_post_link( '%link' ); ?>
    </div>
</nav>
