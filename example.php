<?php

use e621\Auth;
use e621\HTTPException;
use e621\Posts\Posts;

require __DIR__ . '/vendor/autoload.php';
// Auth::login('username', 'api_key');


try {
    $info = Posts::page(1, options: [
        'tags' => [
            'anthro'
        ],
        'limit' => 10
    ]);

    foreach ($info as $post) {
        echo $post['id'] . PHP_EOL;
    }

    echo $info->getSID() . ' ' . $info->getLID();
} catch (HTTPException $e) {
    echo 'There was a problem (' . $e->getCode() . '):' . PHP_EOL . $e->getMessage();
} catch (Exception $e) {
    echo 'Error caught:' . PHP_EOL . $e->getMessage();
}
