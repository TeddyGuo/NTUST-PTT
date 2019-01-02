<?php
    if( function_exists( 'the_ad_placement' ) )
    {
        the_ad_placement('PLACEMENT_SLUG');
    }
    include_once("home.html");
?>