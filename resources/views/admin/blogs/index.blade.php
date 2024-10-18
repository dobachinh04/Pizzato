@extends('admin.layouts.master')

@section('title')
    Danh Sách Blog - Pizzato
@endsection

@section('content')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    @if (Session::has('success'))
        <div class="alert alert-success solid alert-dismissible fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Hoàn Tất!</strong> {{ Session::get('success') }}.
        </div>
    @endif

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0">Danh Sách Blog</h5>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-success ms-auto">Thêm Mới</a>
                            </div>

                            <div class="card-body">
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </th>
                                            {{-- <th data-ordering="false">SR No.</th> --}}
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>Category ID</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                                        value="option1">
                                                </div>
                                            </th>
                                            <td>01</td>
                                            <td>VLZ-452</td>
                                            <td>VLZ1400087402</td>
                                            <td><a href="#!">Post launch reminder/ post list</a></td>
                                            <td>Joseph Parker</td>
                                            <td>Alexis Clarke</td>
                                            <td>Joseph Parker</td>
                                            <td>03 Oct, 2021</td>
                                            <td><span class="badge bg-info-subtle text-info">Re-open</span></td>
                                            <td><span class="badge bg-danger">High</span></td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a href="#!" class="dropdown-item"><i
                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                View</a>
                                                        </li>
                                                        <li><a class="dropdown-item edit-item-btn"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit</a></li>
                                                        <li>
                                                            <a class="dropdown-item remove-item-btn">
                                                                <i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr> --}}
                                        @foreach ($blogs as $stt => $blog)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox"
                                                            name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td>{{ $stt + 1 }}</td>
                                                <td>{{ $blog->user_id }}</td>
                                                <td>{{ $blog->category_id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                                        style="width: 75px; height: 75px; object-fit: cover"
                                                        alt="Ảnh Người Dùng">
                                                </td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->slug }}</td>
                                                <td>{{ $blog->description }}</td>
                                                <td>{{ $blog->status }}</td>
                                                <td>{{ $blog->created_at }}</td>
                                                <td>{{ $blog->updated_at }}</td>
                                                <td>

                                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                                        class="btn btn-warning">Sửa</a>

                                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                                        style="display: inline;"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </td>
                                                <td><span class="badge bg-danger">High</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="/velzon/assets/js/pages/datatables.init.js"></script>
@endsection
