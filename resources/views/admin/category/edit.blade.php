<form action="{{ route('admin.category.update', $category->id) }}" method="POST">
    @csrf


    <div class="modal-body">
        {{-- Category Name --}}
        <div class="form-group">
            <label for="category_name">Category Name *</label>
            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name"
                value="{{ old('category_name', $category->category_name) }}" required>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Category</button>
    </div>
</form>
