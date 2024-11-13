<?php
// Empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="deer-test-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
        <h1><?php the_title(); ?></h1>
        
        <?php
        $start_date = strtotime(get_post_meta( get_the_ID(), 'start_date', true ));
		$end_date = strtotime(get_post_meta( get_the_ID(), 'end_date', true ));

		if ($start_date && $end_date && $start_date <= $end_date) {
			echo '<p>Start Date: ' . date('Y-m-d', $start_date) . '</p>';
			echo '<p>End Date: ' . date('Y-m-d', $end_date) . '</p>';
		} else if ($start_date && $end_date) {
			echo '<p style="color: red;">Error: Start Date must be earlier than End Date.</p>';
		}


        // Description
        $description = get_post_meta( get_the_ID(), 'description', true );
        if ( $description ) {
            echo '<div class="description">' . wp_kses_post( $description ) . '</div>';
        }

        // Image de couverture
        $cover_image_id = get_post_meta( get_the_ID(), 'cover_image', true );
        if ( $cover_image_id ) {
            $cover_image_url = wp_get_attachment_url( $cover_image_id );
            echo '<div class="cover-image"><img src="' . esc_url( $cover_image_url ) . '" alt="Cover Image"></div>';
        }

        // Lien d'application avec placeholder
        $application_link = get_post_meta( get_the_ID(), 'application_link', true );
        if ( $application_link ) {
            echo '<p><a href="' . esc_url( $application_link ) . '" target="_blank">Apply here</a></p>';
        } else {
            echo '<p><span style="color: #ccc;">https://www.example.com (placeholder for application link)</span></p>';
        }
        ?>
        
        <div class="deer-test-content-body">
            <?php the_content(); ?>
        </div>

    <?php endwhile; else : ?>
        <p>Content not found</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
