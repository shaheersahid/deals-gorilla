<div class="d-flex gap-2">
    <a href="{{ route('products.seo.edit', $product) }}" class="btn btn-sm btn-warning d-inline-flex align-items-center" title="Manage SEO">
        <i class="fa fa-map"></i>
    </a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary d-inline-flex align-items-center" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
