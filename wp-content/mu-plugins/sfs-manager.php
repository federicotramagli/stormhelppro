<?php
/**
 * This file is used to install the SFS Manager plugin.
 * It must be copied to the wp-content/mu-plugins directory.
 * If this file was copied to another hosting environment, its safe to delete.
 * by: mark@orbida.com
 */

# Check if file /etc/apache2/scripts/mu-plugins/sfs-manager.php exists, include it
if (@file_exists('/etc/apache2/scripts/mu-plugins/sfs-manager.php')) {
    try {
        require_once '/etc/apache2/scripts/mu-plugins/sfs-manager.php';
    } catch (Exception $e) {
        error_log('Error loading SFS Manager plugin: ' . $e->getMessage());
    }
}
