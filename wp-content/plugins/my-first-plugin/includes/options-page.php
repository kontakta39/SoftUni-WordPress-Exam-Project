<?php
$fruits_homepage_post_per_page = get_option('fruits_homepage_post_per_page', 3);

if (isset($_POST['fruits_save']) && $_POST['fruits_save'] == 1) {
    $fruits_posts_per_page = isset($_POST['fruits_homepage_post_number']) ? $_POST['fruits_homepage_post_number'] : 3;
    if ($fruits_posts_per_page === '' || $fruits_posts_per_page < 1) {
        $fruits_posts_per_page = 3; // Set default value to 3 if empty or less than 1
    }
    update_option('fruits_homepage_post_per_page', $fruits_posts_per_page);
    $fruits_homepage_post_per_page = $fruits_posts_per_page;
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form id="fruits-options-form" method="post">
        <div>
            <label for="fruits_homepage_post_number"><?php _e('Fruits number of posts on the homepage:', 'softuni'); ?></label>
            <input type="number" id="fruits_homepage_post_number" name="fruits_homepage_post_number" value="<?php echo esc_attr($fruits_homepage_post_per_page); ?>">
        </div>
        <div>
            <input type="submit" id="fruits-update-button" name="fruits_save" value="Update">
        </div>
        <input class="primary" type="hidden" name="fruits_save" value="1">
    </form>
</div>