<?php

function crb_get_socials() {
	return array('mail', 'facebook', 'twitter');
}

function crb_get_social_fields() {
	$fields = array();
	$socials = crb_get_socials();
	if ( empty($socials) ) {
		return $fields;
	}

	foreach ($socials as $social) {
		$fields[] = Carbon_Field::factory('text', 'crb_social_' . $social, ucfirst($social) . __(' link', 'crb'))
			->set_default_value('http://' . $social . '.com/');
	}

	return $fields;
}

// Returns social array, foreach ($socials as $slug => $link) {
function crb_get_social_links() {
	$social_links = array();
	$socials = crb_get_socials();

	foreach ($socials as $social) {
		$social_link = carbon_get_theme_option('crb_social_' . $social);
		if ( empty($social_link) ) {
			continue;
		}

		$social_links[$social] = $social_link;
	}


	return $social_links;
}

function test_it_out(){
	return 'hello world';
}

/**
*Get the twitter feed data for SMF
**/
function get_twitter_feed(){

	$settings = array(
	    'oauth_access_token' => "88026503-fymRZnUOaViw0Lq4uZU6VMlloAL8QGEEbpNiFC0P4",
	    'oauth_access_token_secret' => "t3tF0QZpjCxnsW4tT62hLXo8H0PRs9zELFBrQ6KDezxsC",
	    'consumer_key' => "NpNj0OCNBBKV1hThnnzUHYych",
	    'consumer_secret' => "8nrWTunjdfECNclLZR7EeR2itNh29ApCmXv6AL9OC4MePCmHfN"
	);


	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=smfchicken&count=2';
	$requestMethod = 'GET';

	$twitter = new CrbTwitterAPIExchange($settings);
	$twitter_data = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

	$data = json_decode($twitter_data, true);

	return $data;
}

function twitter_links($text)
{
	// convert URLs into links
	$text = preg_replace(
		"#(https?://([-a-z0-9]+\.)+[a-z]{2,5}([/?][-a-z0-9!\#()/?&+]*)?)#i", "<a href='$1' target='_blank'>$1</a>",
		$text);
	// convert protocol-less URLs into links
	$text = preg_replace(
		"#(?!https?://|<a[^>]+>)(^|\s)(([-a-z0-9]+\.)+[a-z]{2,5}([/?][-a-z0-9!\#()/?&+.]*)?)\b#i", "$1<a href='http://$2'>$2</a>",
		$text);
	// convert @mentions into follow links
	$text = preg_replace(
		"#(?!https?://|<a[^>]+>)(^|\s)(@([_a-z0-9\-]+))#i", "$1<a href=\"http://twitter.com/$3\" title=\"Follow $3\" target=\"_blank\">@$3</a>",
		$text);
	// convert #hashtags into tag search links
	$text = preg_replace(
		"#(?!https?://|<a[^>]+>)(^|\s)(\#([_a-z0-9\-]+))#i", "$1<a href='http://twitter.com/search?q=%23$3' title='Search tag: $3' target='_blank'>#$3</a>",
		$text);
	return $text;
}

function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'd',
                60 * 60                 =>  'h',
                60                      =>  'm',
                1                       =>  's'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . $str . ' ago';
        }
    }
}