<div class="d-flex gap-2">
    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info" title="View">
        <i class="fa fa-eye"></i>
    </a>
    <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
