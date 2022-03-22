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
                            Brands
                        </h4>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <th>{{ $brands->firstItem() + $loop->index }}</th>
                                            <td>{{ $brand->name }}</td>
                                            <td><img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}"
                                                    width="70" height="40"></td>
                                            <td>{{ $brand->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ url('brands/' . $brand->id . '/edit') }}">Edit</a>
                                                <a class="btn btn-danger"
                                                    href="{{ url('brands/' . $brand->id . '/delete') }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h4 class="card-header">
                            Add Brand
                        </h4>
                        <div class="card-body">
                            <form method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name">
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="image" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image">
                                </div>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
