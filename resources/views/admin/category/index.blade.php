@extends('admin.layouts.admin')
@section('title')
    Category
@endsection

@section('admin_content')
    <div class="content-wrapper p-3">
        <!-- Content Header -->
        <div class="content-header mb-3">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <!-- Modal trigger button -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i> Add New
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Categories here</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Category Name</th>
                                            <th>Category Slug</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $key => $category)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->category_slug }}</td>
                                                <td>
                                                    @if ($category->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-sm edit"
                                                        data-id="{{ $category->id }}" data-toggle="modal"
                                                        data-target="#editModal">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a id="delete"
                                                        href="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No categories found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="mt-2">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Category insert modal --}}
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_name">Category Name *</label>
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                    placeholder="Category Name" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status *</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add New Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- edit modal --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modal_body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin_assets/plugins/ajax.js') }}"></script>
    <script>
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            $.get("category/edit/" + id, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>
@endsection
