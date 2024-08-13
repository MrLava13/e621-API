<?php

namespace e621\Posts;

use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Posts\Objects\PostObject;
use e621\Posts\Objects\PostsReturnObject;
use Exception;

class Post
{
    private const
        URIS = [
            'upload' => 'uploads.json',
            'post' => 'posts/'
        ],
        CONVERT = [
            'url' => 'direct_url',
            'parent' => 'parent_id',
            'referer' => 'referer_url',
            'reason' => 'edit_reason'
        ];

    /**
     * Upload a post to e621, it might work, might not... It has **not** been tested yet, but should work if I had read the documentaion correctly
     */

    public static function create(array $data): PostsReturnObject
    {
        if (count(array_diff_key(['tags' => null, 'rating' => null], $data)) !== 0) {
            throw new Exception('Missing required keys');
        }
        foreach (self::CONVERT as $o => $n) {
            if (isset($data[$o])) {
                $data[$n] = $data[$o];
            }
        }
        $post = array_intersect_key(
            $data,
            array_flip([
                'rating',
                'direct_url',
                'description',
                'parent_id',
                'referer_url',
                'md5_confirmation',
                'as_pending'
            ])
        );
        if (isset($data['sources'])) {
            $post['source'] = implode(
                PHP_EOL,
                (count($data['sources']) > 10 ?
                    array_slice($data['sources'], 0, 10) :
                    $data['sources'])
            );
        }
        $post['tag_string'] = (is_array($data['tags'])
            ? implode(' ', $data['tags'])
            : $data['tags']);

        if (isset($data['file'])) {
            $post['file'] = curl_file_create(realpath($data['file']), \mime_content_type($data['file']), basename($data['file'])); // TODO: make better
            if (!isset($post['md5_confirmation'])) {
                $post['md5_confirmation'] = md5_file($data['file']);
            }
        } elseif (!isset($post['direct_url']))
            throw new Exception('No file was supplied...');

        $out = [];
        foreach ($post as $name => $value) {
            $out['upload[' . $name . ']'] = $value;
        }

        return new PostsReturnObject(HTTP::fetch(self::URIS['upload'], Method::POST, $post));
    }

    public static function fromID(int $id): PostObject
    {
        return new PostObject(HTTP::fetch(self::URIS['post'] . $id . '.json', Method::GET));
    }

    /**
     * TODO: Only make it update the new keys
     */

    public static function update(int $id, array $data): PostsReturnObject
    {
        $old = (self::fromID($id))->getArray();

        foreach (self::CONVERT as $o => $n)
            if (isset($data[$o]))
                $data[$n] = $data[$o];

        $post = [
            'old_parent_id'     => $old['relationships']['parent_id'],
            'old_description'   => $old['description'],
            'old_rating'        => $old['rating']
        ];
        $post = array_merge(
            $post,
            array_intersect_key($data, array_flip([
                'parent_id',
                'description',
                'rating',
                //'is_rating_locked',
                //'is_note_locked',
                'edit_reason',
                //'has_embedded_notes'
            ]))
        );
        return new PostsReturnObject(HTTP::fetch(self::URIS['post'] . '.json', Method::PATCH, $post));
    }
}
