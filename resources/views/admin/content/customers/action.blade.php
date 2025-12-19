<div class="d-flex gap-2">
    <a href="{{ route('customers.edit', $user) }}" class="btn btn-sm btn-primary" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
    <form action="{{ route('customers.destroy', $user) }}" method="POST" class="del_confirm">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
