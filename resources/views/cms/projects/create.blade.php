@extends('layouts.cms')

@section('content')
<div class="container">
    <h2>Tambah Project</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada kesalahan pada inputan:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('cms.projects._form', ['buttonText' => 'Simpan'])
    </form>
</div>
@endsection
