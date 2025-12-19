<div class="d-flex gap-2">
    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info" title="View">
        <i class="fa fa-eye"></i>
    </a>
    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="del_confirm">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
