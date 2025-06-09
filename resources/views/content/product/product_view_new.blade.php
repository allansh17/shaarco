@extends('layouts/contentNavbarLayout')
@section('title', 'Product Management')
@section('content')
<style>
    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .product-table th, .product-table td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .product-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .product-details img {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product-header {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .product-card {
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .pdf-link {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .pdf-link:hover {
        text-decoration: underline;
    }
</style>

<section class="product-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0 product-header">{{ __('Product Management') }}</h3>
        <a class="btn btn-primary" href="{{ url('product') }}">
            <i class='bx bx-list-ul'></i> List of Inquiry
        </a>
    </div>

    <div class="product-details">
        <table class="product-table">
            <tr>
                <th>Product Name</th>
                <td>{{ $data->name ?? 'Product Name Not Available' }}</td>
            </tr>
            <tr>
                <th>Product Image</th>
                <td><img src="{{ asset('uploads/product/product_image/' . $data->product_image) }}" alt="Product Image"></td>
            </tr>
            <tr>
                <th>Product Slug</th>
                <td>{{ $data->slug ?? 'Product slug Not Available' }}</td>
            </tr>
            <tr>
                <th>SKU</th>
                <td>{{ $data->sku ?? 'Product SKU Not Available' }}</td>
            </tr>
            <tr>
                <th>Summary</th>
                <td>{{ $data->summary ?? 'Product Summary Not Available' }}</td>
            </tr>
            <!-- <tr>
                <th>Stock Quantity</th>
                <td>{{ $data->stock_quantity ?? 'Product Stock Quantity Not Available' }}</td>
            </tr> -->
            <tr>
                <th>Stock Status</th>
                <td>{{ $data->stock_status ?? 'Product Stock Status Not Available' }}</td>
            </tr>
            <tr>
                <th>Full Description</th>
                <td>{{ $data->full_description ?? 'Product Full Description Not Available' }}</td>
            </tr>
            <!-- Clickable Link to View PDF -->
            <tr>
                <th>Attachment (PDF)</th>
                <td>
                    @if($data->attachments)
                        <a href="{{ asset('uploads/product/attachments/' . $data->attachments) }}" target="_blank" class="pdf-link">Click to View PDF</a>
                    @else
                        <p>No attachment available.</p>
                    @endif
                </td>
            </tr>
            <tr>
                <th>normal_price</th>
                <td>{{ $data->normal_price ?? 'Product normal_price Not Available' }}</td>
            </tr>
            <tr>
                <th>wholesaler_price</th>
                <td>{{ $data->wholesaler_price ?? 'Product wholesaler_price Not Available' }}</td>
            </tr>
            <tr>
                <th>	loyal_price</th>
                <td>{{ $data->loyal_price ?? 'Product loyal_price Not Available' }}</td>
            </tr>
            <tr>
                <th>measurements</th>
                <td>{{ $data->measurements ?? 'Product measurements Not Available' }}</td>
            </tr>
            <tr>
                <th>status</th>
                <td>{{ $data->status ?? 'Product status Not Available' }}</td>
            </tr>
            <tr>
                <th>best_seller</th>
                <td>{{ $data->best_seller ?? 'Product best_seller Not Available' }}</td>
            </tr>
            <tr>
                <th>new_products</th>
                <td>{{ $data->new_products ?? 'Product new_products Not Available' }}</td>
            </tr>
            <tr>
                <th>most_populer</th>
                <td>{{ $data->most_populer ?? 'Product most_populer Not Available' }}</td>
            </tr>
           
        </table>
    </div>
</section>

@endsection
