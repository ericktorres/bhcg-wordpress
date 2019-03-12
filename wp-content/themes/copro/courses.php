<?php
/*
    Template Name: Courses
*/
wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/css/bootstrap-for-courses.css');
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.7.0/css/all.css');
get_header(); ?>

	<?php

	$_classes = '';

	// Title Logic
	if( ( false == ivan_get_option('title-wrapper-enable-switch') && false == ivan_get_option('page-boxed-page') )
		OR ( true == ivan_get_option('header-negative-height') && false == ivan_get_option('title-wrapper-enable-switch') ) ) :
		do_action( 'ivan_title_wrapper' );
	else :

		if( ( false == ivan_get_option('header-negative-height') && true == ivan_get_option('title-wrapper-enable-switch') )
			OR true == ivan_get_option('page-boxed-page') )
			echo apply_filters('ivan_blog_divider', '<div class="title-wrapper-divider blog-version"></div>');

		if( true == ivan_get_option('title-wrapper-enable-switch') && false == ivan_get_option('page-boxed-page') )
			$_classes .= ' no-title-wrapper';
	endif;
	?>

	<div class="<?php echo apply_filters( 'iv_content_wrapper_classes', 'iv-layout content-wrapper content-full ' ); ?><?php echo esc_attr($_classes); ?>">
		<div class="container">

			<?php
			// Boxed Page Logic
			if( true == ivan_get_option('page-boxed-page') && false == ivan_get_option('header-negative-height') ) : ?>
			<div class="boxed-page-wrapper">

				<?php
				// Adds Title
				if( false == ivan_get_option('title-wrapper-enable-switch') && true == ivan_get_option('page-boxed-page')
					&& false == ivan_get_option('header-negative-height') ) :
					do_action( 'ivan_title_wrapper' );
				endif; ?>

				<div class="boxed-page-inner">
			<?php endif; ?>

				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-12 site-main" role="main">

						<?php get_template_part( 'page-templates/page', 'loop' ); ?>
						
					</div>

				</div>

			<?php
			// Boxed Page Logic
			if( true == ivan_get_option('page-boxed-page') && false == ivan_get_option('header-negative-height') ) : ?>
				</div><!-- .boxed-page-inner -->
			</div><!-- .boxed-page-wrapper -->
			<?php endif; ?>

		</div>
	</div>

	<!-- Here start the courses information -->
	<div class="container">
	<?php
        $request = wp_remote_get('http://cms.bluehand.com.mx/api/v1/get-headquarters');

		if(is_wp_error($request)){
    		return false; // Bail early
		}

		$body = wp_remote_retrieve_body($request);
		$courses = json_decode($body);
		$html = '';

		if(!empty($courses)){
    		$counting = 0;

    		for($i=0; $i<count($courses); $i++){
    			$counting++;
    			setlocale(LC_MONETARY, 'es_MX');

    			$course = $courses[$i];
    			
    			$html .= '<div class="card" style="margin-bottom:15px;">
      						<div class="card-header">
        						<h4 class="my-0 font-weight-normal">'.$course->{'course_name'}.'</h4>
      						</div>
      						<div class="card-body" style="text-align:center;">
      							<div class="row" style="padding:5px;">
      								<div class="col">
      									<span>'.$course->{'location'}.', '.$course->{'city'}.'</span><br>
      									<span>Inicio: '.date('d/m/Y', strtotime($course->{'start_date'})).' a las '.date('H:i', strtotime($course->{'complete_start_date'})).' Hrs.</span><br>
      									<span>Capacidad total: '.$course->{'capacity'}.' personas</span><br>
      									<span>Lugares disponibles: </span><br>
      									<span>Cierre de inscripción </span><br><br>
      									<h1 class="card-title pricing-card-title">'.money_format('%i', $course->{'cost'}).'</h1>
      								</div>
      								<div class="col" style="border-left:1px dotted gray;">
      									<div class="row" style="border-bottom:1px dotted gray;">
      										<div class="col">
      											<p>Instructor:</p>
      											<img width="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHn5TfPkpW-Bwah2fQDwd1tf2yKNA4PZUyP9V5ESPQU7glPKS9oQ">
      											<p>Peter McAllister</p>
      										</div>
      										<div class="col">
      											<p>CV</p>
      											<a href="#"><i class="fas fa-file-pdf fa-3x"></i></a>
      										</div>
      									</div>
      									<div class="row">
      										<div class="col">	
      											<p>Temario del curso</p>
      											<a href="#"><i class="fas fa-file-alt fa-3x"></i></a>
      										</div>
      									</div>
      								</div>
      							</div>
      							<form method="post" action="/checkout">
      								<input type="hidden" id="hdn_course_id" name="hdn_course_id" value="'.$course->{'course_id'}.'">
      								<input type="hidden" id="hdn_headquarter_id" name="hdn_headquarter_id" value="'.$course->{'headquarter_id'}.'">
      								<input type="hidden" id="hdn_course_name" name="hdn_course_name" value="'.$course->{'course_name'}.'">
      								<input type="hidden" id="hdn_course_code" name="hdn_course_code" value="'.$course->{'code'}.'">
      								<input type="hidden" id="hdn_cost" name="hdn_cost" value="'.$course->{'cost'}.'">
                                    <input type="hidden" id="hdn_location" name="hdn_location" value="'.$course->{'location'}.', '.$course->{'city'}.'">
                                    <input type="hidden" id="hdn_start_time" name="hdn_start_time" value="Inicio: '.date('d/m/Y', strtotime($course->{'start_date'})).' a las '.date('H:i', strtotime($course->{'complete_start_date'})).' Hrs.">
        							<button type="submit" class="btn btn-lg btn-block btn-primary">INSCRIBIRME</button>
        						</form>
      						</div>
    					</div>';
    		}

    		echo $html;
		}
    ?>
    	</div>
	</div>
	

<?php get_footer(); ?>