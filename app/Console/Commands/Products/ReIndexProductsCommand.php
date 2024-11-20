<?php

namespace App\Console\Commands\Products;

use App\Models\Product\Product;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReIndexProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:re-index-products-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $elastic = ClientBuilder::fromConfig(config('elastic'));

        Product::query()
            ->whereHasMerchants()
            ->with('merchants')
            ->chunk(10000 , function ($products) use ($elastic) {
                $bulkParams = ['body' => []];
                $products->each(function (Product $product) use ($elastic,&$bulkParams) {
                    $bulkParams['body'][] = [
                        'index' => [
                            '_index' => 'products',
                            '_id'    => $product->id,
                        ]
                    ];
                    $bulkParams['body'][] = [
                        'id'          => $product->id,
                        'name'        => $product->name,
                        'description' => $product->description,
                        'slug'        => $product->slug,
                        'sku'         => $product->sku,
                        'price'       => $product->price
                    ];
                });
                try {
                    $elastic->bulk($bulkParams);
                    $this->info("Indexed a chunk of products.");
                } catch (\Exception $e) {
                    $this->error("Failed to index products chunk.");
                }
            });
    }
}
