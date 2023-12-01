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
    <form action="{{ route('view.rangking') }}" method="GET">
        <div class="row justify-content-center">
            {{-- <div class="col-2">
                <select class="form-select" aria-label="Default select example" name="type">
                    <option value="saw" {{ $type == 'saw' ? 'selected' : '' }}>SAW</option>
                    <option value="wp" {{ $type == 'wp' ? 'selected' : '' }}>WP</option>
                    <option value="topsis" {{ $type == 'topsis' ? 'selected' : '' }}>TOPSIS</option>
                    <option value="multimoora" {{ $type == 'multimoora' ? 'selected' : '' }}>Multimoora</option>
                </select>
            </div> --}}
            <div class="col-5">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="search"
                        aria-describedby="inputGroup-sizing-default" placeholder="search by name">
                    <button type="input" class="btn btn-dark ms-2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </form>

    <br>
    <div class="alert alert-success text-center" role="alert">
        result calculate
    </div>
    <br>

    <table class="table table-striped shadow-lg">
        @if ($type == 'saw')
            <thead>
                <tr>
                    <th scope="col">Alternatif ID</th>
                    <th scope="col">Alternatif Name</th>
                    <th scope="col">Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <td>{{ $data->alternatif_id }}</td>
                        <td>{{ $data->alternatif_name }}</td>
                        <td>{{ $data->rangking }}</td>
                    </tr>
                @endforeach
            </tbody>
        @elseif ($type == 'wp')
            <thead>
                <tr>
                    <th scope="col">Alternatif ID</th>
                    <th scope="col">Alternatif Name</th>
                    <th scope="col">Nilai V</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <td>{{ $data->alternatif_id }}</td>
                        <td>{{ $data->alternatif_name }}</td>
                        <td>{{ $data->nilaiv }}</td>
                    </tr>
                @endforeach
            </tbody>
        @elseif ($type == 'topsis')
            <thead>
                <tr>
                    <th scope="col">Alternatif ID</th>
                    <th scope="col">D Plus</th>
                    <th scope="col">D Min</th>
                    <th scope="col">Nilai V</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <td>{{ $data->alternatif_id }}</td>
                        <td>{{ $data->dplus }}</td>
                        <td>{{ $data->dmin }}</td>
                        <td>{{ $data->nilaiv ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        @elseif ($type == 'multimoora')
            <thead>
                <tr>
                    <th scope="col">Alternatif ID</th>
                    <th scope="col">Hasil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <td>{{ $data->alternatif_id }}</td>
                        <td>{{ $data->hasil ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>

    <br>
    <div class="alert alert-dark text-center" role="alert">
        the histories
    </div>
    <br>

    <table class="table table-striped shadow-lg">
        <thead>
            <tr>
                <th scope="col">History ID</th>
                <th scope="col">Name Alternatif</th>
                <th scope="col">Name Kriteria</th>
                <th scope="col">Bobot Value</th>
                <th scope="col">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataHistory as $history)
                @foreach ($history->historyDetails as $data)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $data->alternatif->name }}</td>
                        <td>{{ $data->kriteria->name }}</td>
                        <td>{{ $data->bobot->value }}</td>
                        <td>{{ $history->result_value }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection

@section('script-body')
@endsection
