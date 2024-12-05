@extends('admin.layouts.master')

@section('title')
    Cập Nhật Sản Phẩm - Pizzato
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cập Nhật Sản Phẩm</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <h3>Thông Tin Sản Phẩm</h3>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>Name</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $product->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Slug</label>
                                                <div class="input-group">
                                                    <input type="text" name="slug"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        value="{{ old('slug', $product->slug) }}">
                                                    <button type="button" id="generate-slug" class="btn btn-secondary">Tạo
                                                        slug</button>
                                                </div>
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Mã sản phẩm</label>
                                                <div class="input-group">
                                                    <input type="text" id="sku" name="sku"
                                                        class="form-control @error('sku') is-invalid @enderror"
                                                        value="{{ old('sku', $product->sku) }}"
                                                        placeholder="Nhập mã sản phẩm">
                                                    <button type="button" id="generate-sku" class="btn btn-secondary">Ngẫu
                                                        nhiên</button>
                                                </div>
                                                @error('sku')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="category_id" class="form-label">Catalogue</label>
                                                <select type="text" class="form-select" id="category_id"
                                                    name="category_id">
                                                    @foreach ($categories as $id => $name)
                                                        <option value="{{ $id }}"
                                                            {{ $product->category_id == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>View</label>
                                                <input type="text" name="view" class="form-control"
                                                    value="{{ old('view', $product->view) }}" disabled placeholder="0">
                                                @error('view')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="thumb_image" class="form-label">Ảnh Chính</label>
                                                <input type="file" class="form-control" id="thumb_image"
                                                    name="thumb_image">
                                                @if ($product->thumb_image)
                                                    <img src="{{ \Storage::url($product->thumb_image) }}" width="100px"
                                                        height="100px" alt="image">
                                                @endif

                                                @error('thumb_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <style>
                                                .product-galleries {
                                                    display: flex;
                                                    flex-wrap: wrap;
                                                    /* Cho phép các ảnh xuống dòng nếu không đủ chỗ */
                                                    gap: 10px;
                                                    /* Khoảng cách giữa các ảnh */
                                                }

                                                .gallery-item {
                                                    position: relative;
                                                    display: inline-block;
                                                    margin: 5px;
                                                    /* Khoảng cách giữa các ảnh */
                                                }

                                                .gallery-item img {
                                                    border: 1px solid #ddd;
                                                    border-radius: 5px;
                                                    width: 100px;
                                                    /* Đặt kích thước ảnh nếu cần */
                                                    height: 100px;
                                                    object-fit: cover;
                                                }

                                                .delete-gallery {
                                                    /* position: absolute !important; */
                                                    /* top: -5px !important; Căn chỉnh khoảng cách từ đỉnh */
                                                    /* right: -5px !important; Căn chỉnh khoảng cách từ bên phải */
                                                    background-color: red;
                                                    color: white;
                                                    border: none;
                                                    border-radius: 50%;
                                                    /* width: 20px; */
                                                    /* height: 20px; */
                                                    /* text-align: center; */
                                                    /* line-height: 23px; Để chữ X nằm giữa nút */
                                                    /* font-size: 14px; */
                                                    /* cursor: pointer; */
                                                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                                }

                                                .delete-gallery:hover {
                                                    background-color: darkred;
                                                    /* Hiệu ứng khi hover */
                                                }
                                            </style>

                                            {{-- <div class="form-group mt-3">
                                                <label for="galleries" class="form-label">Các Ảnh Phụ</label>
                                                <input type="file" class="form-control" id="galleries" name="galleries[]"
                                                    multiple>
                                                @error('galleries.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <div class="product-galleries">
                                                    @foreach ($product->productGalleries as $item)
                                                        @if ($item->galleries && \Storage::exists($item->galleries))
                                                            <div class="gallery-item">
                                                                <img class="mt-1"
                                                                    src="{{ \Storage::url($item->galleries) }}"
                                                                    width="65px" height="65px" style="object-fit: cover"
                                                                    alt="">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </div> --}}

                                            <div class="form-group mt-3">
                                                <label for="galleries" class="form-label">Các Ảnh Phụ</label>
                                                <input type="file" class="form-control" id="galleries" name="galleries[]"
                                                    multiple>
                                                @error('galleries.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <div class="product-galleries d-flex flex-wrap mt-2">
                                                    @foreach ($product->productGalleries as $item)
                                                        @if ($item->galleries && \Storage::exists($item->galleries))
                                                            <div class="gallery-item position-relative me-2 mb-2">
                                                                <img src="{{ \Storage::url($item->galleries) }}"
                                                                    width="65px" height="65px" style="object-fit: cover"
                                                                    alt="">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-gallery"
                                                                    data-id="{{ $item->id }}"
                                                                    style="transform: translate(50%, -50%);">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                                <input type="hidden" name="keep_galleries[]"
                                                                    value="{{ $item->id }}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-6">
                                            <div class="form-group mt-3">
                                                <label>Giá sản phẩm</label>
                                                <input type="number" name="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $product->price) }}">
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Offer Price</label>
                                                <input type="number" name="offer_price" class="form-control"
                                                    value="{{ old('offer_price', $product->offer_price) }}">
                                                @error('offer_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Số lượng</label>
                                                <input type="text" name="qty"
                                                    class="form-control @error('qty') is-invalid @enderror"
                                                    value="{{ old('qty', $product->qty) }}">
                                                @error('qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Show at Home</label>
                                                <select name="show_at_home" class="form-control">
                                                    <option value="1"
                                                        {{ $product->show_at_home == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0"
                                                        {{ $product->show_at_home == 0 ? 'selected' : '' }}>No</option>
                                                </select>
                                                @error('show_at_home')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Short Description</label>
                                                <textarea name="short_description" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Long Description</label>
                                                <textarea name="long_description" class="form-control summernote">{{ old('long_description', $product->long_description) }}</textarea>
                                                @error('long_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row" id="variantFields" style="display: none;">
                                        <h3>Biến Thể Sản Phẩm</h3>
                                        <!-- Sizes -->
                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                    <input type="checkbox" class="form-check-input toggle-input"
                                                        id="toggleSize">
                                                    <label class="form-check-label" for="toggleSize">Size Bánh</label>
                                                </div>
                                            </div>
                                            <div class="form-group toggle-target" id="inputSizeFields"
                                                style="display: none;">
                                                <select class="form-select mt-3" multiple
                                                    aria-label="multiple select example" name="sizes[]">
                                                    @foreach ($sizes as $size)
                                                        <option @selected(in_array($size->id, $productSizes)) value="{{ $size->id }}">
                                                            {{ $size->name }} -
                                                            {{ number_format($size->price, 0, ',', '.') }} VND
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Viền bánh -->
                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                    <input type="checkbox" class="form-check-input toggle-input"
                                                        id="toggleEdge">
                                                    <label class="form-check-label" for="toggleEdge">Viền Bánh</label>
                                                </div>
                                            </div>
                                            <div class="form-group toggle-target" id="inputEdgeFields"
                                                style="display: none;">
                                                <select class="form-select mt-3" multiple
                                                    aria-label="multiple select example" name="edges[]">
                                                    @foreach ($edges as $edge)
                                                        <option @selected(in_array($edge->id, $pizzaEdges)) value="{{ $edge->id }}">
                                                            {{ $edge->name }} -
                                                            {{ number_format($edge->price, 0, ',', '.') }} VND
                                                        </option>
                                                    @endforeach
                                                </select>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Đế bánh -->
                                        <div class="col-4">
                                            <div class="form-group mt-3">
                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                    <input type="checkbox" class="form-check-input toggle-input"
                                                        id="toggleBase">
                                                    <label class="form-check-label" for="toggleBase">Đế Bánh</label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3 toggle-target" id="inputBaseFields"
                                                style="display: none;">
                                                <select class="form-select mt-3" multiple
                                                    aria-label="multiple select example" name="bases[]">
                                                    @foreach ($bases as $base)
                                                        <option @selected(in_array($base->id, $pizzaBases)) value="{{ $base->id }}">
                                                            {{ $base->name }} -
                                                            {{ number_format($base->price, 0, ',', '.') }} VND
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                            Quay Lại</a>
                                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy các phần tử cần thiết
            const categorySelect = document.getElementById("category_id");
            const variantFields = document.getElementById("variantFields");

            // Hàm kiểm tra và cập nhật hiển thị của variantFields
            function toggleVariantFields() {
                const selectedCategory = categorySelect.options[categorySelect.selectedIndex].text.trim();
                if (selectedCategory === "Pizza") {
                    variantFields.style.display = "flex"; // Giữ bố cục ngang
                } else {
                    variantFields.style.display = "none"; // Ẩn
                }
            }

            // Gọi hàm khi thay đổi danh mục
            categorySelect.addEventListener("change", toggleVariantFields);

            // Gọi hàm khi tải trang lần đầu
            toggleVariantFields();
        });

        //  JS: Xóa ảnh khỏi UI và ghi lại ID ảnh bị xóa
        // Ảnh phụ
        document.addEventListener('DOMContentLoaded', function() {
            const galleryItems = document.querySelectorAll('.delete-gallery');
            galleryItems.forEach(button => {
                button.addEventListener('click', function() {
                    const galleryItem = this.closest('.gallery-item');
                    galleryItem.remove(); // Loại bỏ ảnh khỏi giao diện
                });
            });
        });

        // Biến thể
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy danh sách tất cả các nút switch
            const toggleInputs = document.querySelectorAll('.toggle-input');

            toggleInputs.forEach(toggleInput => {
                toggleInput.addEventListener('change', function() {
                    // Tìm div target tương ứng với id
                    const targetId = this.id.replace('toggle', 'input') + 'Fields';
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        // Hiển thị hoặc ẩn div
                        targetElement.style.display = this.checked ? 'block' : 'none';
                    }
                });
            });
        });

        // // Size
        // document.addEventListener('DOMContentLoaded', function() {
        //     const toggles = document.querySelectorAll('.toggle-input');
        //     const addSizeFieldsButton = document.getElementById('addSizeFields');
        //     const sizeFieldsContainer = document.getElementById('sizeFieldsContainer');

        //     toggles.forEach(function(toggle) {
        //         toggle.addEventListener('change', function() {
        //             const targetFieldsId = this.id.replace('toggle', 'input') + 'Fields';
        //             const targetFields = document.getElementById(targetFieldsId);
        //             const priceFieldId = targetFieldsId.replace('Fields', 'Price');
        //             const priceField = document.getElementById(priceFieldId);

        //             // Khi kích hoạt checkbox
        //             if (this.checked) {
        //                 sizeFieldsContainer.style.display = 'block';
        //                 addSizeFieldsButton.style.display = 'inline-block'; // Hiển thị nút thêm
        //             } else {
        //                 sizeFieldsContainer.style.display = 'none';
        //                 addSizeFieldsButton.style.display = 'none'; // Ẩn nút thêm
        //             }
        //         });
        //     });

        //     // Thêm cột input mới khi nhấn vào nút Thêm Giá Trị
        //     addSizeFieldsButton.addEventListener('click', function() {
        //         const newSizeFieldHTML = `
    //     <div class="row">
    //         <div class="col-6">
    //             <label>Tên Size Bánh</label>
    //             <input type="text" name="size_name[]" class="form-control">
    //         </div>
    //         <div class="col-6">
    //             <label>Giá Tiền</label>
    //             <input type="number" name="size_price[]" class="form-control">
    //         </div>
    //     </div>`;
        //         const newRow = document.createElement('div');
        //         newRow.innerHTML = newSizeFieldHTML;
        //         sizeFieldsContainer.appendChild(newRow);
        //     });
        // });
        // // Edge
        // document.addEventListener('DOMContentLoaded', function() {
        //     const addEdgeFieldsButton = document.getElementById('addEdgeFields');
        //     const edgeFieldsContainer = document.getElementById('edgeFieldsContainer');

        //     // Hiển thị hoặc ẩn trường viền bánh khi checkbox thay đổi
        //     const edgeToggle = document.getElementById('toggleEdge');
        //     edgeToggle.addEventListener('change', function() {
        //         if (this.checked) {
        //             edgeFieldsContainer.style.display = 'block';
        //             addEdgeFieldsButton.style.display = 'inline-block'; // Hiển thị nút thêm
        //         } else {
        //             edgeFieldsContainer.style.display = 'none';
        //             addEdgeFieldsButton.style.display = 'none'; // Ẩn nút thêm
        //         }
        //     });

        //     // Thêm cột input mới cho viền bánh khi nhấn vào nút "Thêm Viền"
        //     addEdgeFieldsButton.addEventListener('click', function() {
        //         const newEdgeFieldHTML = `
    //     <div class="row">
    //         <div class="col-6">
    //             <label>Tên Viền Bánh</label>
    //             <input type="text" name="edge_name[]" class="form-control">
    //         </div>
    //         <div class="col-6">
    //             <label>Giá Tiền</label>
    //             <input type="number" name="edge_price[]" class="form-control">
    //         </div>
    //     </div>`;
        //         const newRow = document.createElement('div');
        //         newRow.innerHTML = newEdgeFieldHTML;
        //         edgeFieldsContainer.appendChild(newRow);
        //     });
        // });

        // // base
        // document.addEventListener('DOMContentLoaded', function() {
        //     const addBaseFieldsButton = document.getElementById('addBaseFields');
        //     const baseFieldsContainer = document.getElementById('baseFieldsContainer');

        //     // Hiển thị hoặc ẩn trường đế bánh khi checkbox thay đổi
        //     const baseToggle = document.getElementById('toggleBase');
        //     baseToggle.addEventListener('change', function() {
        //         if (this.checked) {
        //             baseFieldsContainer.style.display = 'block';
        //             addBaseFieldsButton.style.display = 'inline-block'; // Hiển thị nút thêm
        //         } else {
        //             baseFieldsContainer.style.display = 'none';
        //             addBaseFieldsButton.style.display = 'none'; // Ẩn nút thêm
        //         }
        //     });

        //     // Thêm cột input mới cho đế bánh khi nhấn vào nút "Thêm Đế"
        //     addBaseFieldsButton.addEventListener('click', function() {
        //         const newBaseFieldHTML = `
    //     <div class="row">
    //         <div class="col-6">
    //             <label>Tên Đế Bánh</label>
    //             <input type="text" name="base_name[]" class="form-control">
    //         </div>
    //         <div class="col-6">
    //             <label>Giá Tiền</label>
    //             <input type="number" name="base_price[]" class="form-control">
    //         </div>
    //     </div>`;
        //         const newRow = document.createElement('div');
        //         newRow.innerHTML = newBaseFieldHTML;
        //         baseFieldsContainer.appendChild(newRow);
        //     });
        // });
    </script>
@endsection

@section('script')
    <script>
        // Ngẫu nhiên hoặc tự nhập SKU
        document.addEventListener('DOMContentLoaded', function() {
            const generateSkuButton = document.getElementById('generate-sku');
            const ProductSkuInput = document.getElementById('sku');

            // Lưu giá trị mã gốc để so sánh
            const originalCode = ProductSkuInput.value;

            generateSkuButton.addEventListener('click', function() {
                // Random mã giảm giá (10 ký tự, chữ và số)
                const randomCode = Array.from({
                    length: 15
                }, () => {
                    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    return chars[Math.floor(Math.random() * chars.length)];
                }).join('');

                // Gán mã vào ô input
                ProductSkuInput.value = randomCode;
            });

            // Thêm vào form để gửi mã giảm giá khi có sự thay đổi
            const form = document.querySelector('form');

            form.addEventListener('submit', function() {
                // Kiểm tra xem mã có thay đổi không, nếu có thì sẽ gửi mã mới
                if (ProductSkuInput.value !== originalCode) {
                    // Gửi mã mới
                    ProductSkuInput.name = 'sku'; // Đảm bảo trường sku được gửi
                } else {
                    // Giữ nguyên mã cũ
                    ProductSkuInput.name = 'sku'; // Đảm bảo trường sku được gửi
                }
            });
        });

        // Generate name to slug
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.querySelector('input[name="name"]');
            const slugInput = document.querySelector('input[name="slug"]');
            const generateSlugButton = document.getElementById('generate-slug');

            //  chuyển đổi sang tieng viet khong dau
            function removeVietnameseTones(str) {
                return str
                    .normalize('NFD') // Chuẩn hóa chuỗi thành dạng ký tự tổ hợp
                    .replace(/[\u0300-\u036f]/g, '') // Xóa các dấu tổ hợp
                    .replace(/đ/g, 'd')
                    .replace(/Đ/g, 'D');
            }

            // chuyen doi slug->name
            function convertToSlug(text) {
                return removeVietnameseTones(text)
                    .toLowerCase()
                    .trim()
                    .replace(/[\s]+/g, '-') // Thay thế khoảng trắng bằng dấu -
                    .replace(/[^\w\-]+/g, '') // Xóa ký tự không phải chữ, số hoặc dấu -
                    .replace(/\-\-+/g, '-') // Xóa dấu gạch nối kép
                    .replace(/^-+/, '') // Xóa dấu gạch nối đầu
                    .replace(/-+$/, ''); // Xóa dấu gạch nối cuối
            }

            // sự kiện thay đổi trên ô nhập "name"
            nameInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual) {
                    slugInput.value = convertToSlug(nameInput.value);
                }
            });
            // event click button
            generateSlugButton.addEventListener('click', function() {
                // Generate slug từ trường "name"
                slugInput.value = convertToSlug(nameInput.value);
                slugInput.dataset.manual = false; // Đặt lại trạng thái tự động
            });

            // event nhap tren o input
            slugInput.addEventListener('input', function() {
                slugInput.dataset.manual = true; // Đánh dấu rằng người dùng đang tự nhập slug
            });
        });
    </script>
@endsection
