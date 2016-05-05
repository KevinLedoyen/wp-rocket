<?php 
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

add_settings_section( 'rocket_display_preload_options', __( 'Preload options', 'rocket' ), '__return_false', 'rocket_preload' );
add_settings_field(
	'rocket_enable_bot_preload',
	__( 'Activate preload bot:', 'rocket' ),
	'rocket_field',
	'rocket_preload',
	'rocket_display_preload_options',
	array(
		array(
			'type'         => 'checkbox',
			'label'        => __('Manual', 'rocket' ),
			'label_for'    => 'manual_preload',
			'label_screen' => __( 'Activate manual preload (from admin bar or Tools tab of WP Rocket)', 'rocket' ),
			'default'      => 1,
		),
		array(
			'type'         => 'checkbox',
			'label'        => __('Automatic', 'rocket' ),
			'label_for'    => 'automatic_preload',
			'label_screen' => __( 'Activate automatic preload after partial cache clearing', 'rocket' ),
			'default'      => 1,
		),
		array(
			'type'         => 'helper_description',
			'name'         => 'bot_preload',
			'description'  => __( 'WP Rocket uses a bot to preload your content and create the cached files. You can deactivate it if you need to.', 'rocket') . '<br>' . __( 'Manual preload is launched from the admin bar menu or from the Tools tab of WP Rocket.', 'rocket' ) . '<br>' . __( 'Automatic preload is launched after you add/update content on your website.', 'rocket') . '<br>' . __( 'You can read our documentation to learn more about it: <a href="http://docs.wp-rocket.me/article/8-how-the-cache-is-preloaded" target="_blank">http://docs.wp-rocket.me/article/8-how-the-cache-is-preloaded</a>', 'rocket'),
		),
	)
);
add_settings_field(
	'rocket_sitemap_preload_activate',
	 __( 'Sitemap preloading:', 'rocket' ),
	'rocket_field',
	'rocket_preload',
	'rocket_display_preload_options',
	array(
        array(
            'type'         => 'checkbox',
			'label'        => __('Activate the sitemap preloading', 'rocket' ),
			'label_for'    => 'sitemap_preload',
			'label_screen' => __( 'Activate sitemap preloading (from admin bar or Tools tab of WP Rocket)', 'rocket' ),
			'default'      => 0,
        ),
	)
);

if ( function_exists( 'jetpack_sitemap_uri' ) ) {
    $jetpack_xml_sitemap = array(
        'type'         => 'checkbox',
	    'label'        => __('Jetpack XML Sitemaps', 'rocket' ),
	    'label_for'    => 'jetpack_xml_sitemap',
	    'label_screen' => __( 'Preload the sitemap from the Jetpack plugin', 'rocket' ),
	    'default'      => 0,
    );
    $jetpack_xml_sitemap_desc = array(
        'type'			=> 'helper_description',
        'name'			=> 'jetpack_xml_sitemap_desc',
        'description'  => __( 'We automatically detected the sitemap generated by the Jetpack plugin. You can check the option to preload it.', 'rocket' )
    );
}

if ( class_exists( 'GoogleSitemapGeneratorLoader' ) ) {
    $google_xml_sitemap = array(
        'type'         => 'checkbox',
	    'label'        => __('Google XML Sitemaps', 'rocket' ),
	    'label_for'    => 'google_xml_sitemap',
	    'label_screen' => __( 'Preload the sitemap from the Google XML Sitemaps plugin', 'rocket' ),
	    'default'      => 0,
    );
    $google_xml_sitemap_desc = array(
        'type'			=> 'helper_description',
        'name'			=> 'google_xml_sitemap_desc',
        'description'  => __( 'We automatically detected the sitemap generated by the Google XML Sitemaps plugin. You can check the option to preload it.', 'rocket' )
    );
}

if ( defined( 'WPSEO_VERSION' ) && class_exists( 'WPSEO_Sitemaps_Router' ) ) {
    $yoast_seo_xml = get_option( 'wpseo_xml' );
    if ( true === $yoast_seo_xml['enablexmlsitemap'] ) {
       $yoast_xml_sitemap = array(
            'type'         => 'checkbox',
            'label'        => __('Yoast XML sitemap', 'rocket' ),
            'label_for'    => 'yoast_xml_sitemap',
            'label_screen' => __( 'Preload the sitemap from the Yoast SEO plugin', 'rocket' ),
            'default'      => 0,
        );
        $yoast_xml_sitemap_desc = array(
            'type'			=> 'helper_description',
            'name'			=> 'yoast_xml_sitemap_desc',
            'description'  => __( 'We automatically detected the sitemap generated by the Yoast SEO plugin. You can check the option to preload it.', 'rocket' )
        ); 
    }
}

add_settings_field(
	'rocket_sitemap_preload_files',
	 __( 'XML sitemaps to use for preloading:', 'rocket' ),
	'rocket_field',
	'rocket_preload',
	'rocket_display_preload_options',
	array(
		array(
			'type'         => 'textarea',
			'label'        => __( 'Sitemap files to use for preloading', 'rocket' ),
			'name'         => 'sitemaps',
			'label_screen' => __( 'The sitemap files to use for preloading the cache', 'rocket' )
		),
		array(
			'type'			=> 'helper_description',
			'name'			=> 'sitemaps_list_desc',
			'description'  => __( 'Enter the URL of the XML sitemap files (one per line).', 'rocket' )
		),
		$jetpack_xml_sitemap,
		$jetpack_xml_sitemap_desc,
		$google_xml_sitemap,
		$google_xml_sitemap_desc,
		$yoast_xml_sitemap,
		$yoast_xml_sitemap_desc
	)
);