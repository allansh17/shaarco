@extends('layouts/contentNavbarLayout')
@section('title', 'View Inquiry Details')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">{{ __('View Inquiry Details') }}</h3>
        <a class="btn btn-primary" href="{{ url('inquiry') }}">
            <i class='bx bx-list-ul'></i> List of Inquiry
        </a>
    </div>
    <div class="card-body">
        <section id="order-details">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $data->phone }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $data->message }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

@endsection

