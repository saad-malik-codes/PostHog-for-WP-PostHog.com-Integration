<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
delete_option('ph_snippet_code');
delete_option('ph_plugin_enabled');
?> 
