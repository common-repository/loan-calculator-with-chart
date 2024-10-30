<?php
function loan_calculator_create(){
	ob_start();

	$lcwc_body_back_color = get_option('lcwc_body_back_color','#f0f8ff');
	$lcwc_calc_head_color = get_option('lcwc_calc_head_color','#6258A8');
	$lcwc_calc_head_font_size = get_option('lcwc_calc_head_font_size','56');
	$lcwc_loan_calc_details_color = get_option('lcwc_loan_calc_details_color','#9088D2');
	$lcwc_loan_calc_text_color = get_option('lcwc_loan_calc_text_color','#6258A8');
	$lcwc_activ_slider_color = get_option('lcwc_activ_slider_color','#9088d2');
	$lcwc_progress_color = get_option('lcwc_progress_color','#ffffff');
	$lcwc_thumb_bg_color = get_option('lcwc_thumb_bg_color','#ffffff');
	$lcwc_thumb_border_color = get_option('lcwc_thumb_border_color','#9088d2');
	$lcwc_resu_title_color = get_option('lcwc_resu_title_color','#9088D2');
	$lcwc_enable_breakup_chart = get_option('lcwc_enable_breakup_chart','true');
	$lcwc_enable_yearly_breakdown_chart = get_option('lcwc_enable_yearly_breakdown_chart','true');

	$lcwc_calc_title_text = get_option('lcwc_calc_title_text','Loan Calculator');
	$lcwc_principal_text = get_option('lcwc_principal_text','Principal');
	$lcwc_interest_text = get_option('lcwc_interest_text','Total Interest');
	$lcwc_payable_text = get_option('lcwc_payable_text','Total Payable');
	$lcwc_default_loan_amount = get_option('lcwc_default_loan_amount','5000000');
	$lcwc_min_loan_amount = get_option('lcwc_min_loan_amount','1');
	$lcwc_max_loan_amount = get_option('lcwc_max_loan_amount','10000000');
	$lcwc_default_loan_terms = get_option('lcwc_default_loan_terms','16');
	$lcwc_min_loan_terms = get_option('lcwc_min_loan_terms','1');
	$lcwc_max_loan_terms = get_option('lcwc_max_loan_terms','30');
	$lcwc_default_loan_interest = get_option('lcwc_default_loan_interest','9.5');
	$lcwc_min_loan_interest = get_option('lcwc_min_loan_interest','1');
	$lcwc_max_loan_interest = get_option('lcwc_max_loan_interest','15');
	?>
	<style type="text/css">
		.loan_calc_container {
			background-color: <?php echo esc_attr($lcwc_body_back_color); ?>;
		}
		.loan_calc_header h1 {
		    color: <?php echo esc_attr($lcwc_calc_head_color); ?>;
	        font-size: <?php echo esc_attr($lcwc_calc_head_font_size); ?>px !important;
		    margin-top: 0.67em;
		    margin-bottom: 0.67em;
		}
		.loan-detail-text, #loan-calc-price-container {
			color: <?php echo esc_attr($lcwc_loan_calc_details_color); ?>;
		}
		.loan-calc-text {
			color: <?php echo esc_attr($lcwc_loan_calc_text_color); ?>;
		}
		.loan_chart_details {
		    color: <?php echo esc_attr($lcwc_resu_title_color); ?>;
		}
		.loan_calc_container input[type="range"] {
			background-color: <?php echo esc_attr($lcwc_progress_color); ?>;
			background-image: linear-gradient(<?php echo esc_attr($lcwc_activ_slider_color); ?>, <?php echo esc_attr($lcwc_activ_slider_color); ?>);
		}
		.loan_calc_container input[type="range"]::-webkit-slider-thumb {
			border-color: <?php echo esc_attr($lcwc_thumb_bg_color); ?>;
			background: <?php echo esc_attr($lcwc_thumb_border_color); ?>;
		}
	</style>
	<div class="loan_calc_container">
		<div class="loan_calc_header">
			<h1><?php echo esc_attr($lcwc_calc_title_text); ?></h1>
		</div>
		<div class="loan-calc-sub-container">
			<div class="loan_calc_view">
				<div class="loan_calc_details">
					<div>
						<div class="loan-calc-detail">
							<p class="loan-detail-text"><?php echo esc_html('Loan Amount','loan-calculator'); ?></p>
							<p class="loan-calc-text" id="loan-amt-text"></p>
						</div>
						<input type="range" id="loan-amount" value="<?php echo esc_attr($lcwc_default_loan_amount); ?>" min="<?php echo esc_attr($lcwc_min_loan_amount); ?>" max="<?php echo esc_attr($lcwc_max_loan_amount); ?>">
					</div>
					<div>
						<div class="loan-calc-detail">
							<p class="loan-detail-text"><?php echo esc_html('Length','loan-calculator'); ?></p>
							<p class="loan-calc-text" id="loan-period-text"></p>
						</div>
						<input type="range" id="loan-period" value="<?php echo esc_attr($lcwc_default_loan_terms); ?>" min="<?php echo esc_attr($lcwc_min_loan_terms); ?>" max="<?php echo esc_attr($lcwc_max_loan_terms); ?>" step="1">
					</div>
					<div>
						<div class="loan-calc-detail">
							<p class="loan-detail-text"><?php echo esc_html('% Interest','loan-calculator'); ?></p>
							<p class="loan-calc-text" id="interest-rate-text"></p>
						</div>
						<input type="range" id="interest-rate" value="<?php echo esc_attr($lcwc_default_loan_interest); ?>" min="<?php echo esc_attr($lcwc_min_loan_interest); ?>" max="<?php echo esc_attr($lcwc_max_loan_interest); ?>" step="0.5">
					</div>
				</div>
				<div class="loan-calc-footer">
					<p id="loan-calc-price-container"><span id="loan-calc-price"><?php echo esc_html('0','loan-calculator'); ?></span><?php echo esc_html('/mo','loan-calculator'); ?></p>
				</div>
			</div>
			<?php if($lcwc_enable_breakup_chart == 'true'){?>
			<div class="loan_calc_breakup">
				<canvas id="loan_calc_pieChart" width="400" height="400"></canvas>
			</div>
		<?php }else{ ?>
			<style type="text/css">
				.loan_calc_view {
				    width: 100%;
				}
			</style>

		<?php } ?>
		</div>
		<div>
			<div class="loan-details">
				<div class='chart-details'>
					<p class="loan_chart_details"><?php echo esc_attr($lcwc_principal_text); ?></p>
					<p class="chart_loan_calc_detail" id="loan_calc_cp"></p>
				</div>
				<div class='chart-details'>
					<p class="loan_chart_details"><?php echo esc_attr($lcwc_interest_text); ?></p>
					<p class="chart_loan_calc_detail" id="loan_calc_ci"></p>
				</div>
				<div class='chart-details'>
					<p class="loan_chart_details"><?php echo esc_attr($lcwc_payable_text); ?></p>
					<p class="chart_loan_calc_detail" id="loan_calc_ct"></p>
				</div>
			</div>
			<?php if($lcwc_enable_yearly_breakdown_chart == 'true'){?>
				<canvas id="loan_calc_lineChart" height="200px" width="200px"></canvas>
			<?php } ?>
		</div>
	</div>
	<?php
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'loan_calculator', 'loan_calculator_create' );

?>