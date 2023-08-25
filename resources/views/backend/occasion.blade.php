@extends('backend.layout.master')
@section('title','Bigger Admin || OCCASION')
@section('main-content')
<div class="content">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                {{-- <div class="d-none d-md-flex">All carts</div> --}}
                <div class="d-md-flex gap-4 align-items-center">
                    <form class="mb-3 mb-md-0">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select class="form-select" id="sortOrder" onchange="fetchCategory();">
                                    <option value="">Sort by</option>
                                    <option value="desc" selected>Desc</option>
                                    <option value="asc">Asc</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="perPageItem">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="categorySearch" class="form-control" placeholder="Search">
                                    <button class="btn btn-outline-light" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="dropdown ms-auto">
                    <button type="button" class="btn btn-primary" id="AddCategoryBtn">Add Occasion</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive" tabindex="1" >
        <table class="table table-custom table-lg mb-0" id="categoriesTable">
            <thead>
                <tr>
                    <th>SR NO</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Cortie Gemson</td>
                    <td>
                        <span class="badge bg-primary">Processing</span>
                    </td>
                    <td class="text-end">
                        <div class="d-flex">
                            <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">Show</a>
                                    <a href="#" class="dropdown-item">Edit</a>
                                    <a href="#" class="dropdown-item">Delete</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <nav class="mt-4" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        </ul>
    </nav>
    
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('addOccasion') }}" method="post" id="occasion_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Occasion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="isActive">
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeCategorymodelBtn" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('backend/libs/select2/css/select2.min.css')}}" type="text/css">
<style>
    #staticBackdrop .modal-dialog .modal-content .modal-footer {
        padding: 5px;
    }
    #staticBackdrop .modal-dialog .modal-content .modal-footer button {
        padding: 5px 20px;
    }
</style>
@endpush
@push('scripts')
<script src="{{asset('backend/libs/prism/prism.js')}}"></script>
<script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/js/occasion.js')}}"></script>
@endpush