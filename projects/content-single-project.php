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
?>
<div id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="col-xs-12">
        <h1 class="project-title">
            <?php the_title(); ?>
        </h1>
    </div>

    <?php if ( $post->post_excerpt ): ?>
    <div class="col-xs-12 single-project-short-description" itemprop="description">
            <?php echo apply_filters( 'post_excerpt', wpautop( $post->post_excerpt ) ) ?>
    </div>
    <?php endif; ?>

    <?php if (count($images) > 0): ?>
    <div class="col-xs-12 col-md-6">
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
    <?php endif; ?>

    <?php if ($post->post_content): ?>
    <div class="col-xs-12 col-md-6">
        <?php if (count($deets) > 0 ): ?>
        <div class="project-details row">
            <div class="col-xs-12">
            <?php if ($deets["client"]): ?>
                <div class="project-client col-xs-4">
                    <h3>client</h3>
                    <p><?php echo $deets["client"]; ?></p>
                </div>
            <?php endif; ?>
            <?php if ($deets["date"]): ?>
                <div class="project-date col-xs-4">
                    <h3>date</h3>
                    <p><?php echo $deets["date"]; ?></p>
                </div>
            <?php endif; ?>
            <?php if ($deets["location"]): ?>
                <div class="project-location col-xs-4">
                    <h3>location</h3>
                    <p><?php echo $deets["location"]; ?></p>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="project-description row">
            <div class="col-xs-12">
                <div class="col-xs-12"><?php echo apply_filters( 'projects_description', the_content() ); ?></div>
            </div
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
