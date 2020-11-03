<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListArticleTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_fech_single_article()
    {
        $article = factory(Article::class)->create();

        $response = $this->getJson(route('api.v1.articles.show', $article));

        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string)$article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug' => $article->slug,
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);

    }

    /** @test */
    public function can_fetch_all_articles()
    {

        $articles = factory(Article::class)->times(3)->create();

        $response = $this->getJson(route('api.v1.articles.index'));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'articles',
                    'id' => (string)$articles[0]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[0]->title,
                        'slug' => $articles[0]->slug,
                    ],
                    'links' => [
                        'self' => route('api.v1.articles.show', $articles[0])
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string)$articles[1]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[1]->title,
                        'slug' => $articles[1]->slug,
                    ],
                    'links' => [
                        'self' => route('api.v1.articles.show', $articles[1])
                    ]

                ],
                [
                    'type' => 'articles',
                    'id' => (string)$articles[2]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[2]->title,
                        'slug' => $articles[2]->slug,
                    ],
                    'links' => [
                        'self' => route('api.v1.articles.show', $articles[2])
                    ]
                ],
            ],
            'links' => [
                'self' => route('api.v1.articles.index')
            ],
            'meta' => [
                'article_count' => 3
            ]
        ]);
    }
}
