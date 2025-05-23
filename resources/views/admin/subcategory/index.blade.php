@extends('admin.layouts.admin')
@section('title')
    SubCategory
@endsection

@section('admin_content')
<div class="content-wrapper p-3">

    <!-- Header -->
    <div class="content-header mb-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subcategories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus"></i> Add New
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Subcategories</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Subcategory Name</th>
                                        <th>Parent Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subcategories as $key => $subcategory)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td>{{ $subcategory->category->category_name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm edit"
                                                    data-id="{{ $subcategory->id }}"
                                                    data-toggle="modal" data-target="#editModal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a id="delete"
                                                    href="{{ route('admin.subcategory.delete', $subcategory->id) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No subcategories found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.subcategory.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Subcategory</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Subcategory Name *</label>
                            <input type="text" name="subcategory_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Parent Category *</label>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Add Subcategory</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subcategory</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="modal_body"></div>
            </div>
        </div>
    </div>

</div>
<script src="{{ asset('admin_assets/plugins/ajax.js') }}"></script>
<script>
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.get("subcategory/edit/" + id, function(data) {
            $("#modal_body").html(data);
        });
    });
</script>
@endsection
