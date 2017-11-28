<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_can_create_an_article()
    {
        $faker = Faker::create();
        $title = $faker->word;
        $data = [
            'title' => $title,
            'slug' => str_slug($title),
            'excerpt' => $faker->sentence,
            'content' => $faker->paragraph,
            'author_id' => 1,
            'status_id' => 1,
            'date_start' => null,
            'date_end' => null
        ];

        $request = $this->post('api/v1/articles', $data);

        $request->assertStatus(201)
            ->assertJsonStructure(array_keys($data), $data);
    }
}
