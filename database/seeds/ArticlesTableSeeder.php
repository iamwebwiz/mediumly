<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask('How many articles would you like to generate?', 5);

        $this->command->info("Creating {$count} articles...");

        $articles = factory(Article::class, $count)->create();

        $this->command->info('Articles created!');
    }
}
