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
                            Update Brand
                        </h4>
                        <div class="card-body">
                            <form method="POST" action="/brands/{{ $brand->id }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" id="oldImage" name="oldImage"
                                    value="{{ $brand->image }}">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $brand->name }}">
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="image" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control @error('name') is-invalid @enderror"
                                        id="image" name="image">
                                </div>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" width="200"
                                    height="100">

                                <button type="submit" class="btn btn-primary mt-2">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
