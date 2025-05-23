<form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST">
    @csrf

    <div class="modal-body">
        {{-- Subcategory Name --}}
        <div class="form-group">
            <label for="subcategory_name">Subcategory Name *</label>
            <input type="text" name="subcategory_name" id="subcategory_name" class="form-control"
                   placeholder="Subcategory Name"
                   value="{{ old('subcategory_name', $subcategory->subcategory_name) }}" required>
        </div>

        {{-- Category Dropdown --}}
        <div class="form-group">
            <label for="category_id">Parent Category *</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Subcategory</button>
    </div>
</form>
