<?php

namespace App\Services;

use App\Models\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollectionService
{
    /**
     * Create a new collection.
     */
    public function createCollection(array $data): Collection
    {
        return DB::transaction(function () use ($data) {
            $collection = Collection::create([
                'name' => $data['name'],
                'slug' => !empty($data['slug']) ? $data['slug'] : Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'type' => $data['type'],
                'is_active' => !empty($data['is_active']),
            ]);

            if (!empty($data['product_ids'])) {
                $syncData = [];
                foreach ($data['product_ids'] as $index => $productId) {
                    $syncData[$productId] = ['sort_order' => $index];
                }
                $collection->products()->sync($syncData);
            }

            return $collection;
        });
    }

    /**
     * Update an existing collection.
     */
    public function updateCollection(Collection $collection, array $data): Collection
    {
        return DB::transaction(function () use ($collection, $data) {
            $collection->update([
                'name' => $data['name'],
                'slug' => !empty($data['slug']) ? $data['slug'] : Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'type' => $data['type'],
                'is_active' => !empty($data['is_active']),
            ]);

            $syncData = [];
            if (!empty($data['product_ids'])) {
                foreach ($data['product_ids'] as $index => $productId) {
                    $syncData[$productId] = ['sort_order' => $index];
                }
            }
            $collection->products()->sync($syncData);

            return $collection;
        });
    }

    /**
     * Delete a collection.
     */
    public function deleteCollection(Collection $collection): ?bool
    {
        return $collection->delete();
    }

    /**
     * Toggle collection status.
     */
    public function toggleStatus(int $id, bool $status): Collection
    {
        $collection = Collection::findOrFail($id);
        $collection->is_active = $status;
        $collection->save();
        return $collection;
    }

    /**
     * Reorder products within a collection (pivot table).
     */
    public function reorderCollectionProducts(int $collectionId, array $order): bool
    {
        return DB::transaction(function () use ($collectionId, $order) {
            foreach ($order as $item) {
                DB::table('collection_product')
                    ->where('collection_id', $collectionId)
                    ->where('product_id', $item['id'])
                    ->update(['sort_order' => $item['position']]);
            }
            return true;
        });
    }
}
