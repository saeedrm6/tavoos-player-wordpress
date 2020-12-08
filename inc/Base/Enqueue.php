<?php

namespace Inc\Base;

/**
 *
 */
class Enqueue
{

    private $show = true;

    public function register()
    {
        add_action('wp_enqueue_scripts', array($this, 'userScripts'));

        add_filter('the_content', array($this, 'filter_content'));
    }

    public function adminScripts()
    {

    }


    public function userScripts()
    {
        if (have_posts()) :

            while (have_posts()) : the_post();

                preg_match_all("'<video (.*?)>(.*?)</video>'si", get_the_content(), $videos);

                if (count($videos) > 0 && $this->show) {
                    $this->show = false;

                    wp_enqueue_style('video-player', PLUGIN_URI . 'assets/user/css/default.css', array(), '1.0.0', 'all');

                    wp_enqueue_script('video-player-jwplayer', PLUGIN_URI . 'assets/user/js/jwplayer.js', array(), '3.4.0', false);
                }

            endwhile;

            wp_reset_postdata();

        endif;
    }

    public function filter_content($content)
    {
        preg_match_all("'<video (.*?)>(.*?)</video>'si", $content, $videos);

        $vast = get_option('tavoos_player_vast');

        if (count($videos[0]) > 0) {
            $thumbnail = (get_the_post_thumbnail_url() != false) ? get_the_post_thumbnail_url() : '';

            foreach ($videos[0] as $key => $video) {
                preg_match("'src=\"(.*?)\"'si", $video, $src);

                $id = 'player-' . str_shuffle('01234CDEFGHIQRSTUVWXYZ');

                $format = str_replace("?_=1", "", pathinfo($src[1])['extension']);

                $el = '<div id="' . $id . '"></div>';

                $label = '{';

                $label .= '"file"	: "' . $src[1] . '",';

                $label .= '"type"	: "' . $format . '",';

                $label .= '"label"	: "720"';

                $label .= '}';

                $el .= '<script>
		        tavoos_init_player(
		        	"' . $id . '",
		        	"' . $thumbnail . '",
			        [' . $label . '],
			        "' . $vast . '"
		        )
		        </script>';

                $content = str_replace($video, $el, $content);
            }
        }

        return $content;
    }
}