<div class="input-group mb-3 mt-3">
    <select class="custom-select" id="paginator" name="items_per_page">
        @foreach([5,6,7,8,9,10] as $val)
            <option value="{{ $val }}" {{ $articles->perPage() == $val ? 'selected' : '' }}>{{ $val }}</option>
        @endforeach
    </select>
    <div class="input-group-append">
        <label class="input-group-text" for="paginator">Items per page</label>
    </div>
</div>