<?php
/**
 * Adds Education Web Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Education Web 1.0.0
 *
 * @param null
 * @return null
 *
 */
function education_web_widgets($widgets) {
    $theme_widgets = array(
        'Education_web_aboutus',
        'Education_web_academics',
        'Education_web_blogs',
        'Education_web_clientlogo',
        'Education_web_courses',
        'Education_web_faq',
        'Education_web_featureservices',
        'Education_web_mainservices',
        'Education_web_team',
        'Education_web_testimonial',
        'Education_web_whychoose'
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('education-web');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'education_web_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Education Web 1.0.0
 *
 * @param null
 * @return null
 *
 */
function education_web_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => esc_html__('OT Education Web Widgets', 'education-web'),
        'filter' => array(
            'groups' => array('education-web')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'education_web_widgets_tab', 20);