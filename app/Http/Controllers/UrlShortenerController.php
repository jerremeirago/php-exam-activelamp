<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\UrlShortenerInterface;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Domain;

class UrlShortenerController extends Controller
{
    public $urlShortenerInterface;

    public function __construct(UrlShortenerInterface $interface)
    {
        $this->urlShortenerInterface = $interface; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'allData' => $this->urlShortenerInterface->getAll()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate url
        $validator = Validator::make($request->all(),[
            'url' => ['required' , new Domain()]
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'failed',
                'error' => 'Not a valid URL'
            ];
        }

        // validate to be sure
        $validated = $validator->validated();

        // get only the url
        $validated = $validator->safe()->only(['url']);

        $data = [
            // to avoid malicious scripts or XSS
            'url' => htmlentities($validated['url']),
            // hash url
            'short_url' => $this->urlShortenerInterface->generateRandomStr(5)
        ];

        // check if url was already exists
        $current = $this->urlShortenerInterface->findByUrl($validated['url']);

        $isExists = false;
        if (empty($current)) {
            // new entry
            $result = $this->urlShortenerInterface->store($data);
        } else {
            // return the existing one 
            $result = $current;
            $isExists = true;
        }

        // shorten url
        $shortenUrl = url()->current() . '/' . $result->short_url;

        return [
            'status' => 'success',
            'shortenUrl' => $shortenUrl,
            'exists' => $isExists
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function show($shortUrl)
    {
        $data = $this->urlShortenerInterface->findByShortUrl($shortUrl)->toArray();

        if (empty($data)) {
            return redirect()->toRoute('/');
        }

        // get original url
        $originalUrl = $data['url'];

        return Redirect::to($originalUrl);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function edit(UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UrlShortener $urlShortener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UrlShortener  $urlShortener
     * @return \Illuminate\Http\Response
     */
    public function destroy(UrlShortener $urlShortener)
    {
        //
    }
}
