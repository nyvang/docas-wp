<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://ccnn.dk
 * @since      1.0.0
 *
 * @package    Docas
 * @subpackage Docas/admin/partials
 */
?>
<?php echo "
<div class='wrap'>
	<h2>DoCAS settings</h2>
	<form method='post' action='options.php'>
		<?php settings_fields( 'docas-user-settings-group' ); ?>
		<?php do_settings_sections( 'docas-user-settings-group' ); ?>
		<table class='form-table'>
        <tr valign='top'>
        <th scope='row'>Vendor ID</th>
        <td><input type='text' name='docas-vendor-id' value='<?php echo esc_attr( get_option('docas-vendor-id') ); ?>' /></td>
        </tr>
         
        <tr valign='top'>
        <th scope='row'>Read Only API Key</th>
        <td><input type='text' name='docas-read-only-api-key' value='<?php echo esc_attr( get_option('docas-read-only-api-key') ); ?>' /></td>
        </tr>
        
        <tr valign='top'>
        <th scope='row'>API Key</th>
        <td><input type='text' name='docas-api-key' value='<?php echo esc_attr( get_option('docas-api-key') ); ?>' /></td>
        </tr>
    </table>

    <?php submit_button(); ?>
	</form>
</div>
"; ?>