<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    //==========ここから削除==========
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    //==========ここまで削除==========
    //==========ここから追加==========
    use RefreshDatabase;
    
    public function testIndex()
    {
        
        $response = $this->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }
    //==========ここまで追加==========


    //==========ここから追加==========
    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }    
    //==========ここまで追加==========

    public function testAuthCreate()
    {
        // テストに必要なUserモデルを「準備」
        $user = factory(User::class)->create(); 

        // ログインして記事投稿画面にアクセスすることを「実行」
        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        // レスポンスを「検証」
        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }

    
}
