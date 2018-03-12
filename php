<?php

//load into Twitter OAuth file
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;


//User Key variables to be used with connection
$consumerKey= "";
    
$consumerSecret= "";   

$accessToken= "";
    
$accessTokenSecret= "";


//Connection request
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$content = $connection->get("account/verify_credentials");

//Test post to twitter account to verify connection
//$statues = $connection->post("statuses/update", ["status" => "test post"]);

//Format is in std object, not array

//Pull request to only show newest 25 tweets
$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

//only keep tweets favorited two or more times
foreach($statuses as $tweet){

    if($tweet->favorite_count >=2){

//pull embeded html of those tweets so they display properly
      $status = $connection->get("statuses/oembed", ["id" => $tweet->id]);
        
        echo $status->html;
    }
}

?>
