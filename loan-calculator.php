<?php
/**
* Plugin Name: Loan Calculator With Chart
* Description: This plugin allows you to Create Loan Calculator.
* Version: 1.0
* Copyright: 2023
* Text Domain: loan-calculator
*/

if (!defined('LOANC_PLUGIN_DIR')) {
  define('LOANC_PLUGIN_DIR',plugins_url('', __FILE__));
}

// Include function files
include_once('inc/lcwc_backend.php');
include_once('inc/lcwc_fronted.php');

function EMI_load_admin_script(){
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'lcwc-admin-script', LOANC_PLUGIN_DIR. '/assets/js/lcwc_admin.js', false, '1.0');
  wp_enqueue_script( 'wp-color-picker-alpha', LOANC_PLUGIN_DIR . '/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '3.0.2', true );
  wp_add_inline_script(
    'wp-color-picker-alpha',
    'jQuery( function() { jQuery( ".color-picker" ).wpColorPicker(); } );'
  );
  wp_enqueue_style( 'style-css', LOANC_PLUGIN_DIR . '/assets/css/lcwc_admin.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'EMI_load_admin_script' );

function LOAN_calculator_loadScriptStyle() {
	wp_enqueue_script('jquery', false, array(), false, false);
	wp_enqueue_script( 'loan_calc_js', LOANC_PLUGIN_DIR . '/assets/js/loan_calc.js', false, '1.0.0' );
	wp_enqueue_style( 'loan_calc_css', LOANC_PLUGIN_DIR . '/assets/css/loan_calc.css', false, '1.0.0' );
	wp_enqueue_script( 'chart_min_js', LOANC_PLUGIN_DIR . '/assets/js/chart.min.js', false, '3.8.0' );		
	$loan_color_var =  array( 
      'laon_enable_breakup_chart' => get_option('lcwc_enable_breakup_chart','true'),
      'laon_payment_breakup_chart_type' => get_option('lcwc_chart_type','doughnut_chart'),
      'laon_chart_principal_loan_color' => get_option('lcwc_principal_loan_color','rgb(54, 162, 235)'),
      'laon_chart_total_interest_color' => get_option('lcwc_total_interest_color','rgb(255, 99, 132)'),
      'laon_enable_yearly_breakdown_chart' => get_option('lcwc_enable_yearly_breakdown_chart','true'),
      'laon_chart_yearly_principal_paid_color' => get_option('lcwc_yearly_principal_paid_color','rgb(54, 162, 235)'),
      'laon_chart_yearly_interest_paid_color' => get_option('lcwc_yearly_interest_paid_color','rgb(255, 99, 132)'),
      'laon_chart_breakup_text' => get_option('lcwc_breakup_text','Total Payment Break-up'),
      'laon_chart_principal_amou_text' => get_option('lcwc_principal_amou_text','Principal Amount'),
      'laon_chart_total_interest_text' => get_option('lcwc_total_interest_text','Total Interest'),
      'laon_chart_year_breakdown_text' => get_option('lcwc_year_breakdown_text','Yearly Payment Breakdown'),
      'laon_chart_year_princ_paid_text' => get_option('lcwc_year_princ_paid_text','Yearly Principal paid'),
      'laon_chart_year_interest_paid_text' => get_option('lcwc_year_interest_paid_text','Yearly Interest paid'),
  );
  wp_localize_script( 'loan_calc_js', 'loan_calc_style', $loan_color_var);
}
add_action( 'wp_enqueue_scripts','LOAN_calculator_loadScriptStyle');