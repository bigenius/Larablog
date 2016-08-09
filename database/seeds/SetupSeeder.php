<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create(['name'=>'Admin' ,'email'=>'admin@example.com','password' => bcrypt('admin')]);
        $this->command->info('- Admin added');
        $page = \App\Page::create(['title'=>'Sample page','body'=>'This is a sample page. Create more pages in the admin dashboard.']);
        $this->command->info('- Sample page added');
        $tag = \App\Tag::create(['title'=>'php']);
        $this->command->info('- Tag added');
        $category = \App\Category::create(['title'=>'Code']);
        $this->command->info('- Category added');
        $post = \App\Post::create(['title'=>'My first post!','body'=>'<p>This is my <strong>first</strong> post, <em>yay</em>! </p>','user_id'=>$user->id, 'published_at' => Carbon::now()]);
        $post->tags()->attach($tag);
        $post->categories()->attach($category);
        $this->command->info('- Sample post added');
        $menu = \App\Menu::create(['title' => 'Menu1']);
        $menu->pages()->attach($page);
    }
}
