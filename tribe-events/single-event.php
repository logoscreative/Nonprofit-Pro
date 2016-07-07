<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( __( '&laquo; All %s', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<?php the_title( '<h1 class="tribe-events-single-event-title summary">', '</h1>' ); ?>

	<div class="updated published tribe-clearfix">
		<h2>
			<?php
			$customsched = get_post_meta(get_the_ID(), 'customsched', true);
			$eventrecurrence = get_post_meta(get_the_ID(), '_EventRecurrence', true);
			$eventrecurrence = $eventrecurrence['recurrence-description'];

			if ( !$customsched && !$eventrecurrence ) { ?>
				<?php echo tribe_events_event_schedule_details(); ?>
			<?php } ?>
			<?php
			if ( tribe_is_recurring_event() && !$customsched && !$eventrecurrence ) { ?>
				| <?php echo tribe_get_recurrence_text(); ?>
			<?php } elseif ( tribe_is_recurring_event() && ( $customsched != '' || $eventrecurrence != '' ) ) { ?>
				<?php echo $customsched;
				echo $eventrecurrence; ?>
			<?php } ?>
			<?php if ( tribe_get_cost() ) : ?>
				| <?php echo tribe_get_cost() ?>
			<?php endif; ?>
			<?php if ( tribe_get_venue() ) : ?>
				| <?php echo tribe_get_venue() ?>
			<?php endif; ?>

		</h2>
	</div>

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</div><!-- #tribe-events-content -->
