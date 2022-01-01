<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{

    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' =>$this->faker->unique()->safeEmail(),
            'title' =>$this->faker->name(),
            'content' =>$this->faker->text(),
        ];
    }
}
