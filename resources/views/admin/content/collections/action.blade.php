<div class="d-flex gap-2">
    <a href="{{ route('collections.edit', $collection->id) }}" class="btn btn-sm btn-primary d-inline-flex align-items-center" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
    <a href="{{ route('collections.products', $collection->id) }}" class="btn btn-sm btn-info d-inline-flex align-items-center" title="View Products">
        <i class="fa fa-eye"></i>
    </a>
    <form action="{{ route('collections.destroy', $collection->id) }}" method="POST" class="del_confirm">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>