<div id="productVariant" class="d-none">
    <div class="row g-3 mb-3 variant-row">
        <div class="col-md-3">
            <label class="form-label fw-semibold">Weight</label>
            <select class="form-select" name="variants[0][weight]">
                <option value="100">100g</option>
                <option value="250">250g</option>
                <option value="500">500g</option>
                <option value="1000">1kg</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Original Price</label>
            <input type="number" min="0" step="0.01" class="form-control" name="variants[0][original_price]"
                placeholder="e.g. 1200">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Discounted Price</label>
            <input type="number" min="0" step="0.01" class="form-control" name="variants[0][discount_price]"
                placeholder="e.g. 999">
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2">
            <button type="button" class="btn btn-success add-variant"><i class="fa fa-plus"></i></button>
            <button type="button" class="btn btn-danger remove-variant"><i class="fa fa-minus"></i></button>
        </div>
    </div>
</div>
