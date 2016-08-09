    <?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->warn('--------------');
        $this->command->info('Setup Started');
        $this->call(SetupSeeder::class);
        $this->command->info('Setup finished');
        $this->command->warn('--------------');

    }
}
