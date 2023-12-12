<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap Links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/product.css">

    <title>CRUD</title>
</head>

<body>
    <div class="container py-5" style="min-height: 100vh;">
        <div class="w-100 ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Create</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>
                            <img src="{{ $product->image }}" id="image" alt="" width="200">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <button type="button" onclick="getProduct({{ $product->id }})" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit">แก้ไข</button>
                            <button type="button" onclick="deleteProduct({{ $product->id }})" class="btn btn-danger">ลบ</button>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>







    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="return createProduct(event)">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">สร้างสินค้า</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="group-image mb-3">
                            <figure class="image-upload shadow bg-white">
                                <input class="img-input" onchange="previewImg()" id="file" type="file" name="image" accept="image/jpeg, image/png, image/jpg" required>
                                <img src="/images/thumbnail.jpg" alt="" id="preview-img" style="width: 100%;">
                            </figure>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">ชื่อสินค้า</span>
                            <input type="text" class="form-control" name="name" aria-describedby="basic-addon1"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">ราคา</span>
                            <input type="text" class="form-control" name="price" aria-describedby="basic-addon1"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="return updateProduct(event)">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">แก้ไขสินค้า</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="group-image mb-3">
                            <figure class="image-upload shadow bg-white">
                                <input class="img-input" onchange="previewImgEdit()" id="file2" type="file" name="image" accept="image/jpeg, image/png, image/jpg">
                                <img src="/images/thumbnail.jpg" alt="" id="preview-img2" style="width: 100%;">
                            </figure>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">ชื่อสินค้า</span>
                            <input type="text" id="name-edit" class="form-control" name="name" aria-describedby="basic-addon1"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">ราคา</span>
                            <input type="text" id="price-edit" class="form-control" name="price" aria-describedby="basic-addon1"
                                required>
                        </div>
                        <input type="hidden" id="product_id" name="id">
                        <input type="hidden" id="image_path" name="image_path">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>









    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"
        integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Bootstrap Links --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- Sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="js/product.js"></script>



</body>

</html>
