<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    public function index()
    {
        $direction = 'asc';
        $sortFields = request('sort')->explode(',');

        foreach ($sortFields as $sortField){
            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortFields = Str::of($sortField)->substr(1);
            }
        }



        return ArticleCollection::make(
            Article::orderBy($sortFields,$direction)->get()
        );
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
