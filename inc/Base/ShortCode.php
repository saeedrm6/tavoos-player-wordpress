<?php 
namespace Inc\Base;

/**
 * 
 */
class ShortCode
{
	public function register()
	{
		add_shortcode( 'video-player', array( $this, 'videoPlayer' ) );
	}

	public function videoPlayer( $atts )
	{
		$id = 'player-' . str_shuffle( '01234CDEFGHIQRSTUVWXYZ' );

		$a = shortcode_atts( array(
			'file' 		=> $atts['file'],
			'thumbnail' => isset($atts['thumbnail']) ? $atts['thumbnail'] : '',
		), $atts );

		preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $a['file'], $result);
		
		if ( !empty( $result ) ) 
		{
		    $file = $result['href'][0];
		}

		$format = pathinfo($file)['extension'];

		$label = '';

		ob_start();

		echo '<div id=' . $id . '></div>';

      
    	$label .= '{';

    	$label .= '"file"	: "' . $file . '",';

    	$label .= '"type"	: "' . $format . '",';

    	$label .= '"label"	: "720"';

    	$label .= '}';

        echo '<script>
        tavoos_init_player(
        	"' . $id . '",
        	"' . $a['thumbnail'] . '",
	        [' . $label . '],
	        ""
        )
        </script>';
		return ob_get_clean();
	}
}