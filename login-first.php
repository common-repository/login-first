<?php
    /**
     * Plugin Name: Login first
     * Plugin URI: https://www.ruurddewind.nl
     * Description: Forces everyone to login before viewing your website. Extremely lightweight and flexible.
     * Version: 1.1
     * Author: Ruurd de Wind
     * Author URI: https://www.linkedin.com/in/dewind
    */


    /** redirect everybody who's not logged in to login screen **/
    function login_first_force_redirect() {
        global $pagenow;
        if (!is_user_logged_in() && $pagenow != 'wp-login.php') {
            auth_redirect();
        }
    }
    add_action('wp', 'login_first_force_redirect');


    /** Enqueue the plugin stylesheet to the login page **/
    function login_first_enqueue_styles() {
        wp_enqueue_style('lf-css',plugin_dir_url(__FILE__) .'assets/css/main.css');
    }
    add_action('login_enqueue_scripts', 'login_first_enqueue_styles');


    /** Hook a message at the right place **/
    function login_first_login_message() {
        ?>
        <div class="login-first-msg">Please login first.</div>
        <?php
    }
    add_action('login_form', 'login_first_login_message', 10, 2);