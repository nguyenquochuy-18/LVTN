@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800">Chi tiết phản hồi</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">#</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="name" readonly value="{{ $contact->name }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>email</label>
                        <input type="text" class="form-control" name="price" readonly value="{{ $contact->email }}">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Mô tả</label>
                <textarea type="text" class="form-control" name="description" readonly>{{ $contact->message }}</textarea>
            </div>
        </div>
    </div>
@endsection
