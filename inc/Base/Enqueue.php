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
        wp_deregister_script('wp-mediaelement');

        wp_deregister_style('wp-mediaelement');

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
        $vast = get_option('tavoos_player_vast');

        $thumbnail = (get_the_post_thumbnail_url() != false) ? get_the_post_thumbnail_url() : '';

        preg_match_all("'\\[video (.*?)\\]\\[\\/video]'si", $content, $mediaElement);

        if (count($mediaElement[0]) > 0) {
            foreach ($mediaElement[1] as $key => $video) {
                preg_match('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $video, $src);

                $id = 'player-tavoos-' . rand(0, 1000);

                $format = str_replace("?_=1", "", pathinfo($src[0])['extension']);

                $el = '<div id="' . $id . '"></div>';

                $label = '{';

                $label .= '"file"    : "' . $src[0] . '",';

                $label .= '"type"    : "' . $format . '",';

                $label .= '"label"   : "720"';

                $label .= '}';

                $el .= '<script>
                tavoos_init_player(
                 "' . $id . '",
                 "' . $thumbnail . '",
                    [' . $label . '],
                    "' . $vast . '"
                )
                </script>';

                $content = str_replace($mediaElement[0][$key], $el, $content);
            }
        } else {
            preg_match_all("'<video (.*?)>(.*?)</video>'si", $content, $videos);

            if (count($videos[0]) > 0) {
                foreach ($videos[0] as $key => $video) {
                    preg_match('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $video, $src);

                    $id = 'player-tavoos-' . rand(0, 1000);

                    $format = str_replace("?_=1", "", pathinfo($src[0])['extension']);

                    $el = '<div id="' . $id . '"></div>';

                    $label = '{';

                    $label .= '"file"   : "' . $src[0] . '",';

                    $label .= '"type"   : "' . $format . '",';

                    $label .= '"label"  : "720"';

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
        }

        return $content;
    }
}