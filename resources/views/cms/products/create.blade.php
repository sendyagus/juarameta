@extends('layouts.cms')

@section('content')
<div class="container">
    <h2>Tambah Product</h2>

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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('cms.products._form', ['buttonText' => 'Simpan'])
    </form>
</div>
@endsection
