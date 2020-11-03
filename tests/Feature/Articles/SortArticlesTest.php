<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SortArticlesTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_can_sort_articles_by_title_asc()
    {
        $article1 = factory(Article::class)->create(['title' => 'C title']);
        $article2 = factory(Article::class)->create(['title' => 'A title']);
        $article3 = factory(Article::class)->create(['title' => 'B title']);

        $url = route('api.v1.articles.index',['sort' => 'title']);

        $this->getJson($url)->assertSeeInOrder([
            'A title',
            'B title',
            'C title',
        ]);

    }

    public function it_can_sort_articles_by_title_desc()
    {
        $article1 = factory(Article::class)->create(['title' => 'C title']);
        $article2 = factory(Article::class)->create(['title' => 'A title']);
        $article3 = factory(Article::class)->create(['title' => 'B title']);

        $url = route('api.v1.articles.index',['sort' => '-title']);

        $this->getJson($url)->assertSeeInOrder([
            'C title',
            'B title',
            'A title',
        ]);
    }

    public function it_can_sort_articles_by_title_and_content_asc()
    {
        $article1 = factory(Article::class)->create(['title' => 'C title']);
        $article2 = factory(Article::class)->create(['title' => 'A title']);
        $article3 = factory(Article::class)->create(['title' => 'B title']);

        $url = route('api.v1.articles.index').'?sort=-title,content';

        dd($url);

        $this->getJson($url)->assertSeeInOrder([
            'A title',
            'B title',
            'C title',
        ]);
    }
}
