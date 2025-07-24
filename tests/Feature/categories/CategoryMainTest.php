<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryMainTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function TestIndex()
    {
        $categories = Category::factory()->count(3)->create();
        $response = $this->get('/category');
        $response->assertStatus(200);
        $data = $response->original->getData();
        dd($data);
        
    }
}
