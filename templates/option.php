<div class="wrap">
	<h1>تنظیمات پلیر طاووس</h1>
	<form method="post" action="options.php">
		<?php settings_fields( 'tavoos-player-settings-group' ); ?>
		<?php do_settings_sections( 'tavoos-player-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">VAST Address</th>
				<td><input type="text" name="tavoos_player_vast" value="<?php echo esc_attr( get_option('tavoos_player_vast') ); ?>" /></td>
			</tr>
		</table>
		<?php submit_button( 'ذخیره' ); ?>
	</form>
    <p>نسخه : 3.4</p>
</div>