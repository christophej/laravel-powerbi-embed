<?php

    namespace BrokenTitan\PowerBI\Providers;

    use BrokenTitan\PowerBI\Client;
    use BrokenTitan\PowerBI\View\Components\Report;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class PowerBIServiceProvider extends ServiceProvider {
        /**
         * @method boot
         * @return void
         */
        public function boot() {
            $this->publishes([
                __DIR__ . "/../../config/powerbi.php" => config_path("powerbi.php")
            ], "config");

            $this->publishes([
                __DIR__ . "/../../public" => public_path("vendor/laravel-powerbi-embed"),
            ], "public");

            $this->loadViewsFrom(__DIR__ . "/../../resources/views", "powerbi");
            $this->loadViewComponentsAs("powerbi", [Report::class]);

            View::composer("powerbi::report", function($view) {
                $data = $view->getData();
                $groupId = $data["groupId"];
                $reportId = $data["reportId"];

                $client = new Client;
                $report = $client->report($groupId, $reportId);
                $embedToken = $client->embedToken($groupId, $reportId);

                $view->with([
                    "reportId" => $reportId,
                    "embedUrl" => $report->embedUrl,
                    "embedToken" => $embedToken->token
                ]);
            });
        }

        /**
         * Register any application services.
         *
         * @return void
         */
        public function register() {
            $this->app->singleton("PowerBI", function($app) {
                return new Client;
            });
        }

        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides() {
            return [Client::class];
        }
    }
