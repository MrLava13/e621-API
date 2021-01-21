<?php

use e621\{exceptions\httpException,Posts,Auth};

require __DIR__."/vendor/autoload.php";
//new Auth("username", "api_key");


try {
    $info = Posts::page(1, options: [
        "tags" => [
            "anthro"
        ],
        "limit" => 10
    ]);

    while($row = $info->fetchArray()) echo $row["id"]."\n";
    
    echo $info->getSID()." ". $info->getLID();
} catch(httpException $e){
    echo "There was a problem (".$e->getCode()."): \n".$e->getMessage();
} catch(Error $e){
    exit ("Error caught:\n".$e->getMessage());
}
