@extends('partials.index')

@section('script-head')
@endsection

@section('content')
    @error('failed')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    @error('name')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-5">
            <form action="{{ route('bobot.index') }}" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="search"
                        aria-describedby="inputGroup-sizing-default" placeholder="search by name">
                    <button type="input" class="btn btn-dark ms-2"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        {{-- <div class="col-2">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProvinceModal">Add
                Bobot</button>
        </div> --}}
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name Kriteria</th>
                <th scope="col">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->kriteria->name }}</td>
                    <td>{{ $data->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-6">
            {{ $datas->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Modal untuk menambahkan provinsi -->
    <div class="modal fade" id="addProvinceModal" tabindex="-1" aria-labelledby="addProvinceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProvinceModalLabel">Add Bobot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('bobot.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Kriteria</label>
                            <select class="form-select" aria-label="Default select example" name="kriteria_id">
                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Value</label>
                            <input type="text" class="form-control" id="name" name="value" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
@endsection
