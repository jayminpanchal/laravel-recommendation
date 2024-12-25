<?php

namespace App\Service;

use App\Configs\AppConfig;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Recommendation
{

    public function getByProductId($productId): array
    {
        $originProduct = Product::where('id', $productId)->first();
        if (!$originProduct) {
            return [];
        }

        $products = Product::where('id', '!=', $productId)->get();
        foreach ($products as $product) {
            $product->score = array_sum([
                $this->calculateWeightForSimilarity($originProduct->category, $product->category, AppConfig::WEIGHTS['category']),
                $this->calculateWeightForSimilarity($originProduct->brand, $product->brand, AppConfig::WEIGHTS['brand']),
                $this->calculateWeightForPrice($originProduct->price, $product->price, AppConfig::WEIGHTS['price']),
            ]);
        }
        $products = $products->sortByDesc(function($item) {
            return $item->score;
        });
        return $products->toArray();
    }

    public function calculateWeightForPrice($price1, $price2, $weight): float
    {
        return $this->euclidean(
                $this->minMaxNorm([$price1], 0, AppConfig::PRICE_RANGE),
                $this->minMaxNorm([$price2], 0, AppConfig::PRICE_RANGE)
            ) * $weight;
    }

    public static function euclidean(array $array1, array $array2, bool $returnDistance = false): float
    {
        $a = $array1;
        $b = $array2;
        $set = [];

        foreach ($a as $index => $value) {
            $set[] = $value - $b[$index] ?? 0;
        }

        $distance = sqrt(array_sum(array_map(function ($x) {
            return pow($x, 2);
        }, $set)));

        if ($returnDistance) {
            return $distance;
        }
        return 1 - $distance;
    }

    public static function minMaxNorm(array $values, $min = null, $max = null): array
    {
        $norm = [];
        $min = $min ?? min($values);
        $max = $max ?? max($values);

        foreach ($values as $value) {
            $numerator = $value - $min;
            $denominator = $max - $min;
            $minMaxNorm = $numerator / $denominator;
            $norm[] = $minMaxNorm;
        }
        return $norm;
    }

    public function calculateWeightForSimilarity($value1, $value2, $weight): float
    {
        if ($value1 == $value2) return $weight;

        return 0;
    }
}
