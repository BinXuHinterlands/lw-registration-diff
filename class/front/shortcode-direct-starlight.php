<?php 
global $lw_general_settings, $current_user, $wpdb;

// Check if the visitor is a search engine bot
function is_search_engine() {
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $bots = array(
        'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot', 'Baiduspider',
        'YandexBot', 'Sogou', 'facebot', 'ia_archiver', 'AhrefsBot'
    );
    
    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    return false;
}

// Check if direct access is enabled
$direct_access_enabled = isset($lw_general_settings['enable_direct_starlight_access']) ? 
    $lw_general_settings['enable_direct_starlight_access'] : 0;

// If it's a search engine bot and the form is not disabled, show a friendly message
if (is_search_engine() && $direct_access_enabled) {
    echo "<div class='lw-wrapper register-page'>";
    echo "<div class='lw-width50 lw-white-bg'>";
    echo "<div class='lw-forma-wrapper lw-form-frame'>";
    echo "<div class='lw-form-frame-inner'>";
    echo "<h2>Become a member of Livewire</h2>";
    echo "<p>Please visit this page directly to register for Livewire's Known to Starlight program.</p>";
    echo "</div></div></div></div>";
    return;
}

// If the form is disabled, show a disabled message
if (!$direct_access_enabled) {
    echo "<div class='lw-wrapper register-page'>";
    echo "<div class='lw-width50 lw-white-bg'>";
    echo "<div class='lw-forma-wrapper lw-form-frame'>";
    echo "<div class='lw-form-frame-inner'>";
    echo "<h2>Registration Temporarily Unavailable</h2>";
    echo "<p>Direct registration is currently unavailable. Please contact Livewire for assistance at livewire@starlight.org.au.</p>";
    echo "</div></div></div></div>";
    return;
}

// Show the registration form normally
$prePouplateData = array();
echo "<div class='lw-wrapper register-page'>";
include("lw_leftsidebar.php");
include("registration-form-a-direct.php");
echo "</div>";
?>