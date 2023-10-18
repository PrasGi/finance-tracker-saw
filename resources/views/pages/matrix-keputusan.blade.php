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
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Result ID</th>
                <th scope="col">Alternatif ID</th>
                <th scope="col">Alternatif Name</th>
                <th scope="col">Kriteria ID</th>
                <th scope="col">Kriteria Name</th>
                <th scope="col">Bobot ID</th>
                <th scope="col">Bobot Value</th>
                <th scope="col">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
                <tr>
                    <td>{{ $data->result_id }}</td>
                    <td>{{ $data->alternatif_id }}</td>
                    <td>{{ $data->alternatif_name }}</td>
                    <td>{{ $data->kriteria_id }}</td>
                    <td>{{ $data->kriteria_name }}</td>
                    <td>{{ $data->bobot_id }}</td>
                    <td>{{ $data->bobot_value }}</td>
                    <td>{{ $data->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script-body')
@endsection
