<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client as guzzle;
use Goutte\Client;
use App\ShortenedUrl;

class ShortenedUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $shortened_links = ShortenedUrl::orderBy('times_visited', 'desc')
                               ->take(100)
                               ->get(['url', 'code', 'shortened_url', 'title', 'times_visited']);

            return response()->json([
                'success' => true,
                'message' => 'Top 100 most visited urls.',
                'data' => [
                    'urls' => $shortened_links
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
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
        try {
            $code = str_random(6);
            $shortened_url = url('/') . '/' . $code;

            ShortenedUrl::create(array(
                'url' => $request->url,
                'code' => $code,
                'shortened_url' => $shortened_url,
                'title' => $this->getTitle($request->url),
            ));

            return response()->json([
                'success' => true,
                'message' => 'Shorten url created succesfully',
                'data' => [
                    'url' => $shortened_url
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $redirectLink = ShortenedUrl::where('shortened_url', $id)->first();

            return response()->json([
                'success' => true,
                'message' => 'Get redirect link.',
                'data' => [
                    'redirect_link' => $redirectLink->url
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Receive url and crawls to the return page title.
     *
     * @param $url
     * @return $title
     */
    public function getTitle($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $title = $crawler->filter('title')->first()->text();
        return $title;
    }
}
