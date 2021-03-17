<?php

use e621\{exceptions\httpException,Posts,Auth};

require __DIR__.'/vendor/autoload.php';
//new Auth('username', 'api_key');


try {
    $info = Posts::page(1, options: [
        'tags' => [
            'anthro'
        ],
        'limit' => 10
    ]);

    while($row = $info->fetchArray()) 
        echo $row['id'] . PHP_EOL;
    
    echo $info->getSID() . ' ' . $info->getLID();
} catch(httpException $e){
    echo 'There was a problem (' . $e->getCode() . '):' . PHP_EOL . $e->getMessage();
} catch(Error $e){
    exit ('Error caught:' . PHP_EOL . $e->getMessage());
}
