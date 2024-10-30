<?php 
add_action( 'admin_menu', 'lcwc_calculator_generator_admin_menu' );

function lcwc_calculator_generator_admin_menu(  ) { 
    add_menu_page(
        'Loan Calculator', // page <title>Title</title>
        'Loan Calculator', // menu link text
        'manage_options', // capability to access the page
        'lcwc_calculator_generator', // page URL slug
        'lcwc_calculator_generator', // callback function /w content
        'dashicons-calculator', // menu icon
        14
    );
}

function lcwc_calculator_generator(  ) { 
    if(isset($_REQUEST['succes']))
    {
        echo '<div class="notice notice-success is-dismissible">
                    <p>setting saved successfully.</p>
                </div>';
    }
?>

<div class="lcwc_main_container">
    <div class="lcwc_inner_div">
        <ul class="nav-tab-wrapper woo-nav-tab-wrapper">
            <li class="nav-tab nav-tab-active" data-tab="lcwc-tab-general"><?php echo __('General','loan-calculator');?></li>
            <li class="nav-tab" data-tab="lcwc-tab-text-settings"><?php echo __('Texts','loan-calculator');?></li>
        </ul>
<?php
settings_fields( 'lcwc_calculator_generator' );
do_settings_sections( 'lcwc_calculator_generator' );
?>
    <form action='<?php echo get_permalink(); ?>' method='post'>
        <div id="lcwc-tab-general" class="tab-content current">
            <div class="lcwc_general_div">
                <table class="form-table">
                    <h1><?php echo esc_html('Calculator Style','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Body Background Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_body_back_color" name="lcwc_body_back_color" data-default-color="#f0f8ff" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_body_back_color','#f0f8ff')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Calculator Heading Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_calc_head_color" name="lcwc_calc_head_color" data-default-color="#6258A8" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_calc_head_color','#6258A8')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Heading Font Size','loan-calculator'); ?></th>
                        <td>
                            <input type="number" id="lcwc_calc_head_font_size" name="lcwc_calc_head_font_size" value="<?php echo esc_attr(get_option('lcwc_calc_head_font_size','56')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Loan Detail Title Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_loan_calc_details_color" name="lcwc_loan_calc_details_color" data-default-color="#9088D2" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_loan_calc_details_color','#9088D2')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Loan Detail Calculator Texts Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_loan_calc_text_color" name="lcwc_loan_calc_text_color" data-default-color="#6258A8" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_loan_calc_text_color','#6258A8')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_slider_div">
                <table class="form-table">
                    <h1><?php echo esc_html('Slider Style','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Active Slider Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_activ_slider_color" name="lcwc_activ_slider_color" data-default-color="#9088d2" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_activ_slider_color','#9088d2')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Progress Slider Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_progress_color" name="lcwc_progress_color" data-default-color="#ffffff" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_progress_color','#ffffff')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Slider Thumb Background Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_thumb_bg_color" name="lcwc_thumb_bg_color" data-default-color="#ffffff" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_thumb_bg_color','#ffffff')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Slider Thumb Border Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_thumb_border_color" name="lcwc_thumb_border_color" data-default-color="#9088d2" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_thumb_border_color','#9088d2')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_result_div">
                <table class="form-table">
                    <h1><?php echo esc_html('Result Setting','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Result Title Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_resu_title_color" name="lcwc_resu_title_color" data-default-color="#9088D2" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_resu_title_color','#9088D2')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_payment_breakup_result">
                <table class="form-table">
                    <h1><?php echo esc_html('Chart Result Setting (payment break-up)','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Enable Total Payment break-up','loan-calculator'); ?></th>
                        <td>
                            <input type="checkbox" name="lcwc_enable_breakup_chart" value="true" <?php checked('true', get_option("lcwc_enable_breakup_chart",'true')); ?>><label><?php echo esc_html('Display payment break-up chart.','loan-calculator');?></label>
                        </td>
                    </tr>
                    <tr class="font-size">
                        <th><?php echo esc_html('Select Chart Type','loan-calculator');?></th>
                        <td>
                            <input type="radio" name="lcwc_chart_type" value="doughnut_chart" <?php checked('doughnut_chart',get_option('lcwc_chart_type')); ?> checked><label for="label-1"><?php echo esc_html('Doughnut Chart','loan-calculator');?></label>
                            <input type="radio" name="lcwc_chart_type" value="pie_chart" <?php checked('pie_chart',get_option('lcwc_chart_type')); ?>><label for="label-1"><?php echo esc_html('Pie Chart','loan-calculator');?></label>
                            <input type="radio" name="lcwc_chart_type" value="bar_chart" <?php checked('bar_chart',get_option('lcwc_chart_type')); ?>><label for="label-1"><?php echo esc_html('Bar Chart','loan-calculator');?></label>
                            <input type="radio" name="lcwc_chart_type" value="polar_area_chart" <?php checked('polar_area_chart',get_option('lcwc_chart_type')); ?>><label for="label-1"><?php echo esc_html('Polar Area Chart','loan-calculator');?></label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Principal Loan Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_principal_loan_color" name="lcwc_principal_loan_color" data-default-color="rgb(54, 162, 235)" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_principal_loan_color','rgb(54, 162, 235)')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Total Interest Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_total_interest_color" name="lcwc_total_interest_color" data-default-color="rgb(255, 99, 132)" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_total_interest_color','rgb(255, 99, 132)')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_yearly_payment_result">
                <table class="form-table">
                    <h1><?php echo esc_html('Chart Result Setting (yearly payment breakdown)','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Enable yearly payment breakdown','loan-calculator'); ?></th>
                        <td>
                            <input type="checkbox" name="lcwc_enable_yearly_breakdown_chart" value="true" <?php checked('true', get_option("lcwc_enable_yearly_breakdown_chart",'true')); ?>><label><?php echo esc_html('Display yearly payment breakdown chart.','loan-calculator');?></label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Yearly Principal paid Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_yearly_principal_paid_color" name="lcwc_yearly_principal_paid_color" data-default-color="rgb(54, 162, 235)" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_yearly_principal_paid_color','rgb(54, 162, 235)')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Yearly Interest paid Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_yearly_interest_paid_color" name="lcwc_yearly_interest_paid_color" data-default-color="rgb(255, 99, 132)" data-alpha-enabled="true" class="color-picker" value="<?php echo esc_attr(get_option('lcwc_yearly_interest_paid_color','rgb(255, 99, 132)')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="lcwc-tab-text-settings" class="tab-content">
            <div class="lcwc_text_chart_setting">
                <table class="form-table">
                    <h1><?php echo esc_html('General setting','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Result Title Color','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_calc_title_text" name="lcwc_calc_title_text" value="<?php echo esc_attr(get_option('lcwc_calc_title_text','Loan Calculator')); ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_text_chart_setting">
                <table class="form-table">
                    <h1><?php echo esc_html('Result Text Setting','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Principal Text ','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_principal_text" name="lcwc_principal_text" disabled value="<?php echo esc_attr(get_option('lcwc_principal_text','Principal')); ?>">
                            <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Interest Text ','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_interest_text" name="lcwc_interest_text" disabled value="<?php echo esc_attr(get_option('lcwc_interest_text','Total Interest')); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html('Total Payable Text ','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_payable_text" name="lcwc_payable_text" disabled value="<?php echo esc_attr(get_option('lcwc_payable_text','Total Payable')); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_breakup_chart_setting">
                <table class="form-table">
                    <h1><?php echo esc_html('Result Chart Setting (payment break-up)','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Total Payment break-up Title Text ','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_breakup_text" name="lcwc_breakup_text" disabled value="<?php echo esc_attr(get_option('lcwc_breakup_text','Total Payment Break-up')); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                    <tr class="font-size">
                        <th><?php echo esc_html('Principal Amount Text','loan-calculator');?></th>
                        <td>
                            <input type="text" id="lcwc_principal_amou_text" name="lcwc_principal_amou_text" disabled value="<?php echo get_option('lcwc_principal_amou_text','Principal Amount'); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                    <tr class="font-size">
                        <th><?php echo esc_html('Total Interest Text','loan-calculator');?></th>
                        <td>
                            <input type="text" id="lcwc_total_interest_text" name="lcwc_total_interest_text" disabled value="<?php echo get_option('lcwc_total_interest_text','Total Interest'); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_breakup_chart_setting">
                <table class="form-table">
                    <h1><?php echo esc_html('Result Chart Setting (yearly payment breakdown)','loan-calculator'); ?></h1>
                    <tr>
                        <th><?php echo esc_html('Yearly Payment Breakdown Title Text ','loan-calculator'); ?></th>
                        <td>
                            <input type="text" id="lcwc_year_breakdown_text" name="lcwc_year_breakdown_text" disabled value="<?php echo esc_attr(get_option('lcwc_year_breakdown_text','Yearly Payment Breakdown')); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                    <tr class="font-size">
                        <th><?php echo esc_html('Yearly Principal paid Text','loan-calculator');?></th>
                        <td>
                            <input type="text" id="lcwc_year_princ_paid_text" name="lcwc_year_princ_paid_text" disabled value="<?php echo get_option('lcwc_year_princ_paid_text','Yearly Principal paid'); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                    <tr class="font-size">
                        <th><?php echo esc_html('Yearly Interest paid Text','loan-calculator');?></th>
                        <td>
                            <input type="text" id="lcwc_year_interest_paid_text" name="lcwc_year_interest_paid_text" disabled value="<?php echo get_option('lcwc_year_interest_paid_text','Yearly Interest paid'); ?>">
                             <label class="ttfcf7_common_link"><?php echo __('Some Options Are Only available in ','tool-tips-for-contact-form-7');?><a href="https://appcalculate.com/product/loan-calculator-with-chart/" target="_blank"><?php echo __('pro version','tool-tips-for-contact-form-7');?></a></label>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="lcwc_breakup_chart_setting">
                <table class="form-table">
                    <h1><?php echo esc_html('Loan Calculator Detail Setting','loan-calculator'); ?></h1>
                    <tr>
                        <th scope="row"><?php echo esc_html('Loan Amount','loan-calculator'); ?></th>
                        <td>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_default_loan_amount" name="lcwc_default_loan_amount" value="<?php echo get_option('lcwc_default_loan_amount','5000000'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Default Loan Amount','loan-calculator'); ?></label>
                            </label>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_min_loan_amount" name="lcwc_min_loan_amount" value="<?php echo get_option('lcwc_min_loan_amount','1'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Minimum Loan Amount','loan-calculator'); ?></label>
                            </label>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_max_loan_amount" name="lcwc_max_loan_amount" value="<?php echo get_option('lcwc_max_loan_amount','10000000'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Maximum Loan Amount','loan-calculator'); ?></label>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo esc_html('Loan Terms (length)','loan-calculator'); ?></th>
                        <td>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_default_loan_terms" name="lcwc_default_loan_terms" value="<?php echo get_option('lcwc_default_loan_terms','16'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Default Loan Terms','loan-calculator'); ?></label>
                            </label>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_min_loan_terms" name="lcwc_min_loan_terms" value="<?php echo get_option('lcwc_min_loan_terms','1'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Minimum Loan Terms','loan-calculator'); ?></label>
                            </label>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_max_loan_terms" name="lcwc_max_loan_terms" value="<?php echo get_option('lcwc_max_loan_terms','30'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Maximum Loan Terms','loan-calculator'); ?></label>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo esc_html('Loan Interest','loan-calculator'); ?></th>
                        <td>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_default_loan_interest" name="lcwc_default_loan_interest" value="<?php echo get_option('lcwc_default_loan_interest','9.5'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Default Loan Interest','loan-calculator'); ?></label>
                            </label>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_min_loan_interest" name="lcwc_min_loan_interest" value="<?php echo get_option('lcwc_min_loan_interest','1'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Minimum Loan Interest','loan-calculator'); ?></label>
                            </label>
                            <label class="lcwc_form_body">
                                <input type="number" id="lcwc_max_loan_interest" name="lcwc_max_loan_interest" value="<?php echo get_option('lcwc_max_loan_interest','15'); ?>"><label class="lcwc_back_desc"><?php echo esc_html('Maximum Loan Interest','loan-calculator'); ?></label>
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <p class="submit">
            <input type="hidden" name="action" value="lcwc_save_option">
            <input type="submit" value="Save Changes" name="submit" class="button-primary">
        </p>
    </form>
    </div>
</div>

    <?php
}

add_action('init','lcwc_add_option_type');

function lcwc_add_option_type(){
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'lcwc_save_option') {

        update_option('lcwc_body_back_color',sanitize_text_field($_REQUEST['lcwc_body_back_color']));
        update_option('lcwc_calc_head_color',sanitize_text_field($_REQUEST['lcwc_calc_head_color']));
        update_option('lcwc_calc_head_font_size',sanitize_text_field($_REQUEST['lcwc_calc_head_font_size']));
        update_option('lcwc_loan_calc_details_color',sanitize_text_field($_REQUEST['lcwc_loan_calc_details_color']));
        update_option('lcwc_loan_calc_text_color',sanitize_text_field($_REQUEST['lcwc_loan_calc_text_color']));
        update_option('lcwc_activ_slider_color',sanitize_text_field($_REQUEST['lcwc_activ_slider_color']));
        update_option('lcwc_progress_color',sanitize_text_field($_REQUEST['lcwc_progress_color']));
        update_option('lcwc_thumb_bg_color',sanitize_text_field($_REQUEST['lcwc_thumb_bg_color']));
        update_option('lcwc_thumb_border_color',sanitize_text_field($_REQUEST['lcwc_thumb_border_color']));
        update_option('lcwc_resu_title_color',sanitize_text_field($_REQUEST['lcwc_resu_title_color']));
        if(!empty($_REQUEST['lcwc_enable_breakup_chart'])) {
            update_option('lcwc_enable_breakup_chart',sanitize_text_field($_REQUEST['lcwc_enable_breakup_chart']));
        }else{
            update_option('lcwc_enable_breakup_chart','');
        }
        update_option('lcwc_chart_type',sanitize_text_field($_REQUEST['lcwc_chart_type']));
        update_option('lcwc_principal_loan_color',sanitize_text_field($_REQUEST['lcwc_principal_loan_color']));
        update_option('lcwc_total_interest_color',sanitize_text_field($_REQUEST['lcwc_total_interest_color']));
        if(!empty($_REQUEST['lcwc_enable_yearly_breakdown_chart'])){
            update_option('lcwc_enable_yearly_breakdown_chart',sanitize_text_field($_REQUEST['lcwc_enable_yearly_breakdown_chart']));
        }else{
            update_option('lcwc_enable_yearly_breakdown_chart','');
        }
        update_option('lcwc_yearly_principal_paid_color',sanitize_text_field($_REQUEST['lcwc_yearly_principal_paid_color']));
        update_option('lcwc_yearly_interest_paid_color',sanitize_text_field($_REQUEST['lcwc_yearly_interest_paid_color']));

        update_option('lcwc_calc_title_text',sanitize_text_field($_REQUEST['lcwc_calc_title_text']));
        update_option('lcwc_principal_text',sanitize_text_field($_REQUEST['lcwc_principal_text']));
        update_option('lcwc_interest_text',sanitize_text_field($_REQUEST['lcwc_interest_text']));
        update_option('lcwc_payable_text',sanitize_text_field($_REQUEST['lcwc_payable_text']));
        update_option('lcwc_breakup_text',sanitize_text_field($_REQUEST['lcwc_breakup_text']));
        update_option('lcwc_principal_amou_text',sanitize_text_field($_REQUEST['lcwc_principal_amou_text']));
        update_option('lcwc_total_interest_text',sanitize_text_field($_REQUEST['lcwc_total_interest_text']));
        update_option('lcwc_year_breakdown_text',sanitize_text_field($_REQUEST['lcwc_year_breakdown_text']));
        update_option('lcwc_year_princ_paid_text',sanitize_text_field($_REQUEST['lcwc_year_princ_paid_text']));
        update_option('lcwc_year_interest_paid_text',sanitize_text_field($_REQUEST['lcwc_year_interest_paid_text']));
        update_option('lcwc_default_loan_amount',sanitize_text_field($_REQUEST['lcwc_default_loan_amount']));
        update_option('lcwc_min_loan_amount',sanitize_text_field($_REQUEST['lcwc_min_loan_amount']));
        update_option('lcwc_max_loan_amount',sanitize_text_field($_REQUEST['lcwc_max_loan_amount']));
        update_option('lcwc_default_loan_terms',sanitize_text_field($_REQUEST['lcwc_default_loan_terms']));
        update_option('lcwc_min_loan_terms',sanitize_text_field($_REQUEST['lcwc_min_loan_terms']));
        update_option('lcwc_max_loan_terms',sanitize_text_field($_REQUEST['lcwc_max_loan_terms']));
        update_option('lcwc_default_loan_interest',sanitize_text_field($_REQUEST['lcwc_default_loan_interest']));
        update_option('lcwc_min_loan_interest',sanitize_text_field($_REQUEST['lcwc_min_loan_interest']));
        update_option('lcwc_max_loan_interest',sanitize_text_field($_REQUEST['lcwc_max_loan_interest']));

        wp_redirect( admin_url( '/admin.php?page=lcwc_calculator_generator&succes=sucee' ));
    }
}

?>