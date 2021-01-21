<?php
namespace e621;

use e621\exceptions\httpException;
use \e621\process\{PATCH,GET,POST as httpPOST};
use Error;

class Post {
    private static $urls = [
        "upload" => "https://e621.net/uploads.json",
        "post" => "https://e621.net/posts/"
    ],
    $convert = [
        "url" => "direct_url",
        "parent" => "parent_id",
        "referer" => "referer_url",
        "reason" => "edit_reason"
    ];

    /**
     * Upload a post to e621, it might work, might not... It has **not** been tested yet, but should work if I had read the documentaion correctly
     */

    public static function create(array $data){
        if(count(array_diff_key(array_flip(["tags","rating"]), $data)) !== 0) throw new Error("Missing required keys");
        foreach(static::$convert as $o => $n) if(isset($data[$o])) $data[$n] = $data[$o];
        $post = array_intersect_key($data,array_flip([
            "rating",
            "direct_url",
            "description",
            "parent_id",
            "referer_url",
            "md5_confirmation",
            "as_pending"
        ]));
        if(isset($data["sources"])) $post["source"] = implode("\n",count($data["sources"]) > 10 ? array_slice($data["sources"],0,10) : $data["sources"]);
        $post["tag_string"] = is_array($data["tags"]) ? implode(" ", $data["tags"]) : $data["tags"];
        if(isset($data["file"])){
            $post["file"] = curl_file_create(realpath($data["file"]),\mime_content_type($data["file"]),basename($data["file"]));
            if(!isset($post["md5_confirmation"])) 
                $post["md5_confirmation"] = md5_file($data["file"]);
        } elseif(!isset($post["direct_url"])) 
            throw new Error("No file was supplied...");
        $out = [];
        foreach($post as $name => $value)
            $out["upload[".$name."]"] = $value;
        
        return new returnObject(httpPOST::s(static::$urls["upload"],$post));
    }

    public static function id(int $id){
        return new returnObject(GET::s(static::$urls["post"].$id.".json"));
    }

    /**
     * Update a post on e621, untested function. Hopfully it works
     */

    public static function update(int $id, array $data){
        try{
            $old = (static::id($id))->fetchArray();
        } catch (httpException $e){
            user_error("Request failed with: \"".$e->getMessage()."\"", E_USER_WARNING);
            return false;
        }
        foreach(static::$convert as $o => $n) if(isset($data[$o])) $data[$n] = $data[$o];
        
        $post = [
            "old_parent_id"=>$old["relationships"]["parent_id"],
            "old_description"=>$old["description"],
            "old_rating"=>$old["rating"]
        ];
        $post = array_merge(
            $post,
            array_intersect_key($data,array_flip([
                "parent_id",
                "description",
                "rating",
                //"is_rating_locked",
                //"is_note_locked",
                "edit_reason",
                //"has_embedded_notes"
            ]))
        );

        return new returnObject(PATCH::s(static::$urls["post"].".json",$post));
    }
}