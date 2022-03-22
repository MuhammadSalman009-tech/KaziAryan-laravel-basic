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
                            Multiple Pics
                        </h4>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($MultiPics as $MultiPic)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="{{ asset($MultiPic->image) }}" alt="" width="100%">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h4 class="card-header">
                            Add Multi Pics
                        </h4>
                        <div class="card-body">
                            <form method="POST" action="{{ route('multi-pic.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="images" class="form-label">Brand Image</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
