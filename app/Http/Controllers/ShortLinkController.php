<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\CrawlerPageTitle;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mostViewedLinks = \App\Models\ShortLink::orderByDesc('number_views')->take(100)->get();

        return view('most-viewed', compact('mostViewedLinks'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newShortUrl = $this->createShortUrl($request->all());
        return view('created_link', compact('newShortUrl'));
    }

    public function show($code)
    {
        $shortUrlId = $this->decode($code);
        $shortUrl = ShortLink::find($shortUrlId);

        if (empty($shortUrl)) {
            abort(404);
        }

        $shortUrl->increment('number_views');
        $urlRedirect = $shortUrl->link;
        return redirect($urlRedirect);
    }

    public static $alphabet = "abcdefghijklmnopqrstuvwxyz0123456789";

    public function validator(array $data)
    {
        $data['full-link'] = $data['full-link'] ?? 0;
        $rules = [
            'full-link' => ['required', 'url'],
        ];

        return Validator::make($data, $rules);
    }

    public function createShortUrl(array $data)
    {
        $this->validator($data)->validate();

        $short = ShortLink::whereLink($data['full-link'])->first();

        if(!$short){
            $short = ShortLink::create([
                'link' => $data['full-link']
            ], $data);

            $short_link = $this->encode($short->id);
            $short->short = $short_link;
            $short->save();

            CrawlerPageTitle::dispatch($short);
        }

        return $short;
    }

    public static function encode(int $i): string
    {
        if ($i == 0) {
            return self::$alphabet[0];
        }

        $s = '';
        $base = strlen(self::$alphabet);

        while ($i > 0)
        {
            $s .= self::$alphabet[$i % $base];
            $i = (int) $i / $base;
        }

        return strrev($s);
    }

    public static function decode(string $s): int
    {
        $i = 0;
        $base = strlen(self::$alphabet);

        foreach (str_split($s) as $letter)
        {
            $i = ($i * $base) + strpos(self::$alphabet, $letter);
        }

        return $i;
    }

}
