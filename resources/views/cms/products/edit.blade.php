@extends('layouts.cms')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('cms.products._form', ['buttonText' => 'Update'])
    </form>
</div>
@endsection
