<?php 
/* Group Header */
$hassocialnetworks = (
    theme_design_get_setting('facebook') ||
    theme_design_get_setting('twitter') ||
    theme_design_get_setting('linkedin') ||
    theme_design_get_setting('youtube') ||
    theme_design_get_setting('flickr') ||
    theme_design_get_setting('pinterest')
);
?>
<?php if ($hassocialnetworks) {	?>
    <div class="socialnetworks">
        <?php
        echo $OUTPUT->render_social_network('twitter');
        echo $OUTPUT->render_social_network('facebook');
        echo $OUTPUT->render_social_network('linkedin');
        echo $OUTPUT->render_social_network('youtube');
        echo $OUTPUT->render_social_network('flickr');
        echo $OUTPUT->render_social_network('pinterest');
        ?>
    </div>
<?php } ?>
