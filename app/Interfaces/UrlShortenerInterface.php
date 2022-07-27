<?php

namespace App\Interfaces;

interface UrlShortenerInterface
{
    public function store(array $data);

    public function getAll();

    public function generateRandomStr($length);

    public function findByShortUrl($shortUrl);

    public function findByUrl($url);
}
