<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle's Design theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_design
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings = null;

defined('MOODLE_INTERNAL') || die;
global $PAGE;

$ADMIN->add('themes', new admin_category('theme_design', 'Design'));

/* General Settings */
    $temp = new admin_settingpage('theme_design_generic',  get_string('geneicsettings', 'theme_design'));

    // Invert Navbar to dark background.
    $name = 'theme_design/invert';
    $title = get_string('invert', 'theme_design');
    $description = get_string('invertdesc', 'theme_design');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Logo file setting.
    $name = 'theme_design/logo';
    $title = get_string('logo','theme_design');
    $description = get_string('logodesc', 'theme_design');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_design/customcss';
    $title = get_string('customcss', 'theme_design');
    $description = get_string('customcssdesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footnote setting.
    $name = 'theme_design/footnote';
    $title = get_string('footnote', 'theme_design');
    $description = get_string('footnotedesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
	$ADMIN->add('theme_design', $temp);
	
	/* Banner Settings */
    $temp = new admin_settingpage('theme_design_banner', get_string('bannersettings', 'theme_design'));
    
    $temp->add(new admin_setting_heading('theme_design_banner', get_string('bannersettingssub', 'theme_design'),
            format_text(get_string('bannersettingsdesc' , 'theme_design'), FORMAT_MARKDOWN)));
			
	// Set Number of Slides.
    $name = 'theme_design/slidenumber';
    $title = get_string('slidenumber' , 'theme_design');
    $description = get_string('slidenumberdesc', 'theme_design');
    $default = '4';
    $choices = array(
        '0'=>'0',
    	'1'=>'1',
    	'2'=>'2',
    	'3'=>'3',
    	'4'=>'4',
    	'5'=>'5',
    	'6'=>'6',
    	'7'=>'7',
    	'8'=>'8',
    	'9'=>'9',
    	'10'=>'10');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Set the Slide Speed.
    $name = 'theme_design/slidespeed';
    $title = get_string('slidespeed' , 'theme_design');
    $description = get_string('slidespeeddesc', 'theme_design');
    $default = '600';
    $setting = new admin_setting_configtext($name, $title, $description, $default );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $hasslidenum = (!empty($PAGE->theme->settings->slidenumber));
    if ($hasslidenum) {
            $slidenum = $PAGE->theme->settings->slidenumber;
	} else {
            $slidenum = '1';
	}

	$bannertitle = array('Slide One', 'Slide Two', 'Slide Three','Slide Four','Slide Five','Slide Six','Slide Seven', 'Slide Eight', 'Slide Nine', 'Slide Ten');

    foreach (range(1, $slidenum) as $bannernumber) {

    	// This is the descriptor for the Banner Settings.
    	$name = 'theme_design/banner';
        $title = get_string('bannerindicator', 'theme_design');
    	$information = get_string('bannerindicatordesc', 'theme_design');
    	$setting = new admin_setting_heading($name.$bannernumber, $title.$bannernumber, $information);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

        // Enables the slide.
        $name = 'theme_design/enablebanner' . $bannernumber;
        $title = get_string('enablebanner', 'theme_design', $bannernumber);
        $description = get_string('enablebannerdesc', 'theme_design', $bannernumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Title.
        $name = 'theme_design/bannertitle' . $bannernumber;
        $title = get_string('bannertitle', 'theme_design', $bannernumber);
        $description = get_string('bannertitledesc', 'theme_design', $bannernumber);
        $default = $bannertitle[$bannernumber - 1];
        $setting = new admin_setting_configtext($name, $title, $description, $default );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide text.
        $name = 'theme_design/bannertext' . $bannernumber;
        $title = get_string('bannertext', 'theme_design', $bannernumber);
        $description = get_string('bannertextdesc', 'theme_design', $bannernumber);
        $default = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel tincidunt dolor. Aenean vel tellus consequat, euismod mi at, maximus ex. Donec quis sagittis turpis, id feugiat metus.';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Text for Slide Link.
        $name = 'theme_design/bannerlinktext' . $bannernumber;
        $title = get_string('bannerlinktext', 'theme_design', $bannernumber);
        $description = get_string('bannerlinktextdesc', 'theme_design', $bannernumber);
        $default = 'Read More';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Destination URL for Slide Link
        $name = 'theme_design/bannerlinkurl' . $bannernumber;
        $title = get_string('bannerlinkurl', 'theme_design', $bannernumber);
        $description = get_string('bannerlinkurldesc', 'theme_design', $bannernumber);
        $default = '#';
        $previewconfig = null;
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Image.
    	$name = 'theme_design/bannerimage' . $bannernumber;
    	$title = get_string('bannerimage', 'theme_design', $bannernumber);
    	$description = get_string('bannerimagedesc', 'theme_design', $bannernumber);
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'bannerimage'.$bannernumber);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);
    }

    $ADMIN->add('theme_design', $temp); 
    
    /* Social Network Settings */
$temp = new admin_settingpage('theme_design_social', get_string('socialsettings', 'theme_design'));
    $temp->add(new admin_setting_heading('theme_design_social', get_string('socialheadingsub', 'theme_design'),
        format_text(get_string('socialdesc', 'theme_design'), FORMAT_MARKDOWN)));

    // Facebook url setting.
    $name = 'theme_design/facebook';
    $title = get_string('facebook', 'theme_design');
    $description = get_string('facebookdesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Flickr url setting.
    $name = 'theme_design/flickr';
    $title = get_string('flickr', 'theme_design');
    $description = get_string('flickrdesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_design/twitter';
    $title = get_string('twitter', 'theme_design');
    $description = get_string('twitterdesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_design/linkedin';
    $title = get_string('linkedin', 'theme_design');
    $description = get_string('linkedindesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Pinterest url setting.
    $name = 'theme_design/pinterest';
    $title = get_string('pinterest', 'theme_design');
    $description = get_string('pinterestdesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // YouTube url setting.
    $name = 'theme_design/youtube';
    $title = get_string('youtube', 'theme_design');
    $description = get_string('youtubedesc', 'theme_design');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	
    
    $ADMIN->add('theme_design', $temp);
    
    	
     
    /* Footer Settings start */
    $temp = new admin_settingpage('theme_design_footer', get_string('footerheading', 'theme_design'));

    // Footer Block1.
    $name = 'theme_design_footerblock1heading';
    $heading = get_string('footerblock', 'theme_design').' 1 ';
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    /* Footer Content */
    $name = 'theme_design/footnote';
    $title = get_string('footnote', 'theme_design');
    $description = get_string('footnotedesc', 'theme_design');
    $default = 'default';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    /* Footer Block1. */

    /* Footer Block2. */
    $name = 'theme_design_footerblock2heading';
    $heading = get_string('footerblock', 'theme_design').' 2 ';
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    $name = 'theme_design/footerbtitle2';
    $title = get_string('footerblock', 'theme_design').' '.get_string('title', 'theme_design').' 2 ';
    $description = get_string('footerbtitle_desc', 'theme_design');
    $default = 'lang:footerbtitle2default';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_design/footerblink2';
    $title = get_string('footerblink', 'theme_design').' 2';
    $description = get_string('footerblink_desc', 'theme_design');
    $default = get_string('footerblink2default', 'theme_design');
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    /* Footer Block2 */

    /* Footer Block3 */
    $name = 'theme_design_footerblock3heading';
    $heading = get_string('footerblock', 'theme_design').' 3 ';
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    $name = 'theme_design/footerbtitle3';
    $title = get_string('footerblock', 'theme_design').' '.get_string('title', 'theme_design').' 3 ';
    $description = get_string('footerbtitle_desc', 'theme_design');
    $default = 'lang:footerbtitle3default';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /* Facebook,Pinterest,Twitter,Google+ Settings */
    $name = 'theme_design/fburl';
    $title = get_string('fburl', 'theme_design');
    $description = get_string('fburldesc', 'theme_design');
    $default = get_string('fburl_default', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_design/twurl';
    $title = get_string('twurl', 'theme_design');
    $description = get_string('twurldesc', 'theme_design');
    $default = get_string('twurl_default', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_design/gpurl';
    $title = get_string('gpurl', 'theme_design');
    $description = get_string('gpurldesc', 'theme_design');
    $default = get_string('gpurl_default', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_design/pinurl';
    $title = get_string('pinurl', 'theme_design');
    $description = get_string('pinurldesc', 'theme_design');
    $default = get_string('pinurl_default', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    /* Footer Block3. */

    /* Footer Block4. */
    $name = 'theme_design_footerblock4heading';
    $heading = get_string('footerblock', 'theme_design').' 4 ';
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Fooer Block Title 4.
    $name = 'theme_design/footerbtitle4';
    $title = get_string('footerblock', 'theme_design').' '.get_string('title', 'theme_design').' 4 ';
    $description = get_string('footerbtitle_desc', 'theme_design');
    $default = 'lang:footerbtitle4default';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /* Address , Phone No ,Email */
    $name = 'theme_design/address';
    $title = get_string('address', 'theme_design');
    $description = '';
    $default = get_string('defaultaddress', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_design/phoneno';
    $title = get_string('phoneno', 'theme_design');
    $description = '';
    $default = get_string('defaultphoneno', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $name = 'theme_design/emailid';
    $title = get_string('emailid', 'theme_design');
    $description = '';
    $default = get_string('defaultemailid', 'theme_design');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
    /* Footer Block4 */

    $ADMIN->add('theme_design', $temp);
    /*  Footer Settings end */

    