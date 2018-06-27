<?php

use ImLiam\ShareableLink;

if (! function_exists('shareable_link')) {
    /**
     * Automatically generate shareable URLs for various social media websites.
     *
     * @param string $url
     * @param string $title
     * @return ShareableLink
     */
    function shareable_link(string $url, string $title): ShareableLink
    {
        return new ShareableLink($url, $title);
    }
}
