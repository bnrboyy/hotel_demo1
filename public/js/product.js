function createProduct(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form); // name, price

    axios.post("/createproduct", formData).then((response) => {
        if (response.status === 200) {
            Swal.fire({
                icon: "success",
                title: "สร้างสินค้าสำเร็จ",
            }).then(() => window.location.reload());
        } else {
            Swal.fire({
                icon: "error",
                title: "สร้างสินค้าไม่สำเร็จ",
            }).then(() => window.location.reload());
        }
    });
}

function deleteProduct(id) {
    axios.delete(`/delete/${id}`).then((response) => {
        if (response.status === 200) {
            Swal.fire({
                icon: "success",
                title: "ลบสินค้าสำเร็จ",
            }).then(() => window.location.reload());
        } else {
            Swal.fire({
                icon: "error",
                title: "ลบสินค้าไม่สำเร็จ",
            }).then(() => window.location.reload());
        }
    });
}

function getProduct() {
    const trEl = this.event.target.closest("tr");
    const tdEl = trEl.querySelectorAll("td");
    const id = trEl.querySelector("th");
    const image_path = document.querySelector("#image_path");
    const img = tdEl[0].querySelector('#image');
    const preview = document.querySelector('#preview-img2');

    const id_input = document.getElementById("product_id");
    const name_input = document.getElementById("name-edit");
    const price_input = document.querySelector("#price-edit");

    const baseUrl = window.location.origin;
    const old_path = img.src.replace(baseUrl + '/', '');
    preview.src = img.src;
    image_path.value = old_path;
    id_input.value = id.innerText;
    name_input.value = tdEl[1].innerText;
    price_input.value = tdEl[2].innerText;
}

function updateProduct(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form); // name, price

    axios.post("/updateproduct", formData).then((response) => {
        console.log(response);
        if (response.status === 200) {
            Swal.fire({
                icon: "success",
                title: "แก้ไขสินค้าสำเร็จ",
            }).then(() => window.location.reload());
        } else {
            Swal.fire({
                icon: "error",
                title: "แก้ไขสินค้าไม่สำเร็จ",
            }).then(() => window.location.reload());
        }
    });
}

/* Function Preview Image */
function previewImg() {
    const file = document.getElementById("file"); // get DOM
    const img = document.getElementById("preview-img"); // get DOM
    const image = file.files[0];

    let reader = new FileReader();
    reader.onloadend = () => {
        img.src = reader.result;
    };
    reader.readAsDataURL(image);
}

function previewImgEdit() {
    const file = document.getElementById("file2"); // get DOM
    const img = document.getElementById("preview-img2"); // get DOM
    const image = file.files[0];

    let reader = new FileReader();
    reader.onloadend = () => {
        img.src = reader.result;
    };
    reader.readAsDataURL(image);
}
