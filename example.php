<?php

use E621api\Auth;
use E621api\HTTPException;
use E621api\Posts;
use E621api\Posts\PostSearch;

require __DIR__ . '/vendor/autoload.php';
// Auth::login('username', 'api_key');


try {
    $info = Posts::getResults(
        PostSearch::make()
            ->setTags([
                'anthro'
            ])
            ->setLimit(10)
    );

    foreach ($info as $post) {
        echo $post['id'] . PHP_EOL;
    }

    echo $info->getSID() . ' ' . $info->getLID();
} catch (HTTPException $e) {
    echo 'There was a problem (' . $e->getCode() . '):' . PHP_EOL . $e->getMessage();
} catch (Exception $e) {
    echo 'Error caught:' . PHP_EOL . $e->getMessage();
}
