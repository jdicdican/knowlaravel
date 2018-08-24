<?php

use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = array(
            array('title' => 'Article 1', 'body' => 'Lorem ipsum dolor sit amet', 'author_id' => 2),
            array('title' => 'Article 2', 'body' => 'The quick brown fox jumped over the lazy cat', 'author_id' => 2),
            array('title' => 'Article 3', 'body' => 'She sells seashells by the seashore', 'author_id' => 2)
            );

        foreach ($articles as $article) {    
            DB::table('articles')->insert([
                'title' => $article['title'],
                'body' => $article['body'],
                'author_id' => $article['author_id'],
            ]);
        }
    }
}
