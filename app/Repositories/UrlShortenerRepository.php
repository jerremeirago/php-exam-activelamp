<?php


namespace App\Repositories;

use App\Interfaces\UrlShortenerInterface;
use App\Models\UrlShortener;
use Illuminate\Support\Str;

class UrlShortenerRepository implements UrlShortenerInterface
{
    public function store($data)
    {
        return UrlShortener::create($data);
    } 

    /**
     * retrieve all entries
     */
    public function getAll($order = 'DESC',$columns = ['id', 'short_url'])
    {
        return UrlShortener::select($columns)->orderBy('id', $order)->get();
    } 

    public function generateRandomStr($length = 6)
    {
        return Str::random($length);
    }

    public function findByShortUrl($shortUrl)
    {
        $data = UrlShortener::select(['id','url'])->where('short_url', $shortUrl)->first(); 

        return $data;
    }

    public function findByUrl($url)
    {
        $data = UrlShortener::select(['id','short_url'])->where('url', $url)->first(); 

        return $data;
    }
}
