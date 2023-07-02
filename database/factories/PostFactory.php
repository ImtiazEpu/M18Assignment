<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory {
    protected $model = Post::class;

    public function definition(): array {
        return [
            'title'       => $this->faker->words(3, true),
            'content'     => $this->faker->paragraphs(5, true),
            'category_id' => Category::all()->random()->id,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
            'deleted_at'  => null,
        ];
    }
}
