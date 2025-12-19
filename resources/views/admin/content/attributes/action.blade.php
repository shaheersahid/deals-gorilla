<div class="d-flex gap-2">
    <a href="{{ route('attributes.edit', $attribute) }}" class="btn btn-sm btn-primary d-inline-flex align-items-center" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
    <form action="{{ route('attributes.destroy', $attribute) }}" method="POST" class="del_confirm">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
