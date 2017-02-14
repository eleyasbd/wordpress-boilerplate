<?php

namespace FbtWpBpFuncPlug;

/**
 * Class Fbt_Wp_Bp_Func_Plug_Feeds
 * @package FbtWpBpFuncPlug
 */
class Fbt_Wp_Bp_Func_Plug_Feeds
{

    /**
     * @var string
     */
    private static $self = 'FbtWpBpFuncPlug\Fbt_Wp_Bp_Func_Plug_Feeds';

    /**
     *
     */
    public static function run()
    {

        // http://wordpress.stackexchange.com/questions/33072/how-to-remove-feeds-from-wordpress-totally
        add_action('wp_head', [self::$self, 'remove_links'], 1);
        add_action('init', [self::$self, 'kill_feed_endpoint'], 99);

        foreach (array('rdf', 'rss', 'rss2', 'atom') as $feed) {
            add_action('do_feed_' . $feed, [self::$self, 'redirect'], 1);
        }

    }

    /**
     *
     */
    public static function remove_links()
    {

        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);

    }

    /**
     *
     */
    public static function kill_feed_endpoint()
    {
        // This is extremely brittle.
        // $wp_rewrite->feeds is public right now, but later versions of WP
        // might change that
        global $wp_rewrite;
        $wp_rewrite->feeds = array();

    }

    /**
     *
     */
    public static function redirect() {

        // redirect the feeds! don't just kill them
        wp_redirect( home_url(), 302 );
        exit();

    }

}