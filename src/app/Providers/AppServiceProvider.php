<?php
    
    namespace DOTdevSPACE\Poedit\Providers;
    
    use Illuminate\Support\ServiceProvider;
    
    class AppServiceProvider extends
        ServiceProvider {
        
        protected $namespace = 'DOTdevSPACE\Poedit\Http\Controllers';
        
        public function boot() {
            $this->app->router->group([
                'namespace'  => $this->namespace,
                'prefix'     => 'dotdevspace/poedit',
                'middleware' => ['web'],
            ], function () {
                $this->getRoutes(__DIR__ . '/../../routes/');
            });
            
            $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Poedit');
        }
        
        public function register() {
        
        }
        
        public function getRoutes($path) {
            if ($dir = opendir($path)) {
                while (($file = readdir($dir)) !== false) {
                    $filename = "{$path}{$file}";
                    
                    if (!is_dir($filename) && $file !== "." && $file !== "..") {
                        require $filename;
                    } elseif ($file !== "." && $file !== "..") {
                        $this->getRoutes("{$filename}/");
                    }
                }
                
                closedir($dir);
            }
        }
        
    }