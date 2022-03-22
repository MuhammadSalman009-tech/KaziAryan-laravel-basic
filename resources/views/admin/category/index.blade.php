<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <h4 class="card-header">
                            Categories
                        </h4>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th>{{ $categories->firstItem() + $loop->index }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>{{ $category->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ url('/categories/' . $category->id . '/edit') }}">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="{{ url('/categories/soft-delete/' . $category->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h4 class="card-header">
                            Add Category
                        </h4>
                        <div class="card-body">
                            <form method="POST" action="{{ route('categories.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name">
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="card mt-4">
                        <h4 class="card-header">
                            Trashed Categories
                        </h4>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                   @foreach ($trashedCategories as $category)
                                        <tr>
                                            <th>{{ $categories->firstItem() + $loop->index }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>{{ $category->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ url('/categories/restore/' . $category->id) }}">Restore</a>
                                                <a class="btn btn-danger"
                                                    href="{{ url('/categories/permanent-delete/' . $category->id) }}">Permanent
                                                    Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{ $trashedCategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
