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
            <form action="{{ route('result.index') }}" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="search"
                        aria-describedby="inputGroup-sizing-default" placeholder="search by name">
                    <button type="input" class="btn btn-dark ms-2"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        @if (count($datas) < 6)
            <div class="col-2">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addProvinceModal">Add
                    Result</button>
            </div>
        @else
            <div class="col-2 text-end">
                <a type="button" href="{{ route('view.rangking') }}" class="btn btn-primary">Cek
                    Result</a>
            </div>
            <div class="col-2">
                <a type="button" href="{{ route('result.index', ['reset' => 'true']) }}" class="btn btn-danger">Reset</a>
            </div>
        @endif
    </div>
    <table class="table table-striped shadow-lg">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name Alternatif</th>
                <th scope="col">Name Kriteria</th>
                <th scope="col">Bobot Value</th>
                <th scope="col">Value</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->alternatif->name }}</td>
                    <td>{{ $data->kriteria->name }}</td>
                    <td>{{ $data->bobot->value }}</td>
                    <td>{{ $data->value }}</td>
                    <td>
                        <form action="{{ route('result.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-6 text-center shadow-lg">
            <div class="card">
                <div class="card-header">
                    helper
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rasio Mendekati 5:3:2</h5>
                    <p class="card-text"><b>1</b> jika < 50% </p>
                            <p class="card-text"><b>2</b> jika = 50% </p>
                            <p class="card-text"><b>3</b> jika > 50% </p>
                </div>
            </div>
        </div>
        <div class="col-6 text-center shadow-lg">
            <div class="card">
                <div class="card-header">
                    helper
                </div>
                <div class="card-body">
                    <h5 class="card-title"> Prioritas Kebutuhan vs Keinginan</h5>
                    <p class="card-text"><b>1</b> jika kebutuhan < keinginan </p>
                            <p class="card-text"><b>2</b> kebutuhan = keinginan </p>
                            <p class="card-text"><b>3</b> kebutuhan > keinginan </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6">
            {{ $datas->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="modal fade" id="addProvinceModal" tabindex="-1" aria-labelledby="addProvinceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProvinceModalLabel">Add Result 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('result.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h5 class="modal-title" id="addProvinceModalLabel">Rasio Mendekati 5:3:2</h5>
                        <input type="hidden" name="alternatif_id" value="1">
                        <div class="mb-3">
                            <label for="name" class="form-label">Kriteria</label>
                            <select class="form-select" aria-label="Default select example" name="bobot_id">
                                @foreach ($bobots as $bobot)
                                    <option value="{{ $bobot->id }}">{{ $bobot->kriteria->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Value</label>
                            <select class="form-select" aria-label="Default select example" name="value">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
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
