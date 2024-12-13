@extends('admin.layouts.master')

@section('title')
    Danh Mục Món Ăn - Pizzato
@endsection
{{-- demo branch command line --}}
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
                                <h5 class="card-title mb-0">Danh Mục Món Ăn</h5>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-success ms-auto">Thêm mới
                                </a>
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
                                            <!-- <th>ID</th> -->
                                            <th>Tên</th>
                                            <th>Slug</th>
                                            <th>Hình Ảnh</th>
                                            {{-- <th>Trạng Thái Hàng</th> --}}
                                            {{-- <th>Trạng Thái Hiển Thị</th> --}}
                                            <!-- <th>Lần Cuối Cập Nhật</th> -->
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox"
                                                            name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                {{-- <td>{{ $category->id }}</td> --}}
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                {{-- <td>
                                                    <img src="{{ asset('uploads/categories/'.$category->image) }}" width="70px" height="70px" alt="image">
                                                </td> --}}
                                                <td>
                                                    @php
                                                        $url = $category->image;
                                                        if (!\Str::contains($url, 'http')) {
                                                            // $url = \Storage::url($url);
                                                            $url = asset('uploads/categories/' . $category->image);
                                                        } else {
                                                        }
                                                    @endphp
                                                    <img src="{{ $url }}" alt="" width="100px">
                                                </td>
                                                {{-- <td>{{ $category->status == 1 ? 'Còn hàng' : 'Hết hàng' }}</td> --}}
                                                {{-- <td>{{ $category->show_at_home == 0 ? 'Ẩn' : 'Hiển thị' }}</td> --}}
                                                {{-- <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>  --}}
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        class="btn btn-warning"><i class="fa fa-edit"> </i></a>
                                                    {{-- <form action="{{ route('admin.categories.destroy', $category) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}

                                                    @if ($category->products()->exists())
                                                        <!-- Modal trigger button -->
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteCategoryModal-{{ $category->id }}"
                                                            data-url="{{ route('admin.categories.destroy', $category->id) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteCategoryModal-{{ $category->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="deleteCategoryModalLabel-{{ $category->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteCategoryModalLabel-{{ $category->id }}">
                                                                            Xác nhận xóa danh mục
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form id="deleteCategoryForm-{{ $category->id }}"
                                                                        method="POST"
                                                                        action="{{ route('admin.categories.destroy', $category->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-body">
                                                                            <p>Danh mục này còn sản phẩm, bạn muốn thực hiện
                                                                                hành động nào?</p>
                                                                            <div>
                                                                                <label>
                                                                                    <input type="radio" name="action"
                                                                                        value="delete_products" required>
                                                                                    Xóa tất cả sản phẩm trong danh mục
                                                                                </label>
                                                                            </div>
                                                                            <div>
                                                                                <label>
                                                                                    <input type="radio" name="action"
                                                                                        value="move_products">
                                                                                    Chuyển sản phẩm sang danh mục khác:
                                                                                </label>
                                                                                <select name="new_category_id">
                                                                                    <option value="">-- Chọn danh mục
                                                                                        --</option>
                                                                                    @foreach ($categories as $otherCategory)
                                                                                        @if ($otherCategory->id !== $category->id)
                                                                                            <option
                                                                                                value="{{ $otherCategory->id }}">
                                                                                                {{ $otherCategory->name }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div>
                                                                                <label>
                                                                                    <input type="radio" name="action"
                                                                                        value="nullify_products">
                                                                                    Gắn nhãn "Chưa Phân Loại"
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Hủy</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Xóa</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- Simple delete form -->
                                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endif


                                                </td>
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

@section('script ')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const deleteCategoryModal = document.getElementById('deleteCategoryModal');
        //     const deleteCategoryForm = document.getElementById('deleteCategoryForm');

        //     deleteCategoryModal.addEventListener('show.bs.modal', function(event) {
        //         const button = event.relatedTarget; // Nút được bấm để mở modal
        //         const actionUrl = button.getAttribute('data-url'); // Lấy URL từ thuộc tính data-url
        //         deleteCategoryForm.setAttribute('action', actionUrl); // Cập nhật action của form
        //     });
        // });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteCategoryModal = document.querySelectorAll('[data-bs-toggle="modal"]');

            deleteCategoryModal.forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = button.getAttribute('data-bs-target').replace('#', '');
                    const actionUrl = button.getAttribute('data-url');
                    const form = document.querySelector(`#${modalId} form`);

                    if (form) {
                        form.setAttribute('action', actionUrl);
                    }
                });
            });
        });
    </script>
@endsection
