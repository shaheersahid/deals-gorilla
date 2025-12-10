<?php

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

if (!function_exists('format_price')) {
    /**
     * Format a number as currency.
     */
    function format_price($amount, string $currency = '$', int $decimals = 2): string
    {
        if ($amount === null) {
            return $currency . '0.00';
        }
        return $currency . number_format((float) $amount, $decimals);
    }
}

if (!function_exists('generate_slug')) {
    /**
     * Generate a unique slug from a string.
     */
    function generate_slug(string $text, string $table = null, string $column = 'slug'): string
    {
        $slug = Str::slug($text);
        
        if ($table) {
            $originalSlug = $slug;
            $count = 1;
            while (\DB::table($table)->where($column, $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }
        
        return $slug;
    }
}

if (!function_exists('upload_file')) {
    /**
     * Upload a file and return the path.
     */
    function upload_file(UploadedFile $file, string $folder = 'uploads', string $disk = 'public'): string
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $filename, $disk);
    }
}

if (!function_exists('delete_file')) {
    /**
     * Delete a file from storage.
     */
    function delete_file(?string $path, string $disk = 'public'): bool
    {
        if ($path && \Storage::disk($disk)->exists($path)) {
            return \Storage::disk($disk)->delete($path);
        }
        return false;
    }
}

if (!function_exists('parse_specs')) {
    /**
     * Parse specifications array to key-value pairs.
     */
    function parse_specs(?array $specs): ?array
    {
        if (empty($specs)) {
            return null;
        }

        $result = [];
        foreach ($specs as $spec) {
            if (!empty($spec['key']) && isset($spec['value'])) {
                $result[$spec['key']] = $spec['value'];
            }
        }
        
        return !empty($result) ? $result : null;
    }
}

if (!function_exists('get_status_badge')) {
    /**
     * Get Bootstrap badge class for status.
     */
    function get_status_badge(string $status, array $map = []): string
    {
        $defaultMap = [
            'active' => 'success',
            'inactive' => 'danger',
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
            'refunded' => 'secondary',
            'paid' => 'success',
            'failed' => 'danger',
        ];
        
        $map = array_merge($defaultMap, $map);
        $class = $map[$status] ?? 'secondary';
        
        return '<span class="badge bg-' . $class . '">' . ucfirst($status) . '</span>';
    }
}

if (!function_exists('get_active_badge')) {
    /**
     * Get badge for active/inactive status.
     */
    function get_active_badge(bool $isActive): string
    {
        return $isActive 
            ? '<span class="badge bg-success">Active</span>' 
            : '<span class="badge bg-danger">Inactive</span>';
    }
}

if (!function_exists('nullable_or_value')) {
    /**
     * Return null if empty, otherwise return value.
     */
    function nullable_or_value($value)
    {
        return !empty($value) ? $value : null;
    }
}

if (!function_exists('generate_order_number')) {
    /**
     * Generate a unique order number.
     */
    function generate_order_number(string $prefix = 'ORD'): string
    {
        return $prefix . '-' . strtoupper(uniqid());
    }
}

if (!function_exists('generate_sku')) {
    /**
     * Generate a unique SKU.
     */
    function generate_sku(string $prefix = 'SKU'): string
    {
        return $prefix . '-' . strtoupper(Str::random(8));
    }
}
