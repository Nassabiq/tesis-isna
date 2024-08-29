<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:export {name : The name of the export class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new export class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $className = \Str::studly($name) . 'Export';
        $filePath = app_path("Exports/{$className}.php");

        if (File::exists($filePath)) {
            $this->error("The export class {$className} already exists!");
            return;
        }

        $this->makeDirectory(app_path('Exports'));

        File::put($filePath, $this->generateExportClass($className));

        $this->info("Export class {$className} created successfully.");
    }

    protected function generateExportClass($className)
    {
        return <<<PHP
<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class {$className} implements FromCollection
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return collect([]);
    }
}

PHP;
    }

    protected function makeDirectory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}
