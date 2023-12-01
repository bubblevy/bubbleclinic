const Toast = Swal.mixin({
    iconColor: "white",
    customClass: {
        popup: "colored-toast",
    },
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

$("#upload").on("change", function () {
    var file = $(this)[0].files[0];

    if (file && file.type.startsWith("image")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#uploadedPhotoProfil")[0].src = e.target.result;
            $("#uploadedPhotoProfil").css("display", "block");
        };
        reader.readAsDataURL(file);
    } else {
        Toast.fire({
            icon: "warning",
            title: "Yang diupload harus image!",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            toast: true,
            position: "top-end",
        });
    }
});

$(".buttonEditEmailUser").on("click", function () {
    $("#formModalUsersEditEmail").modal("show");
});

$(".btnCancelVerify").on("click", function () {
    $("#passwordVerify").removeClass("is-invalid");
    $("#passwordVerify").val("");
    $("#passwordVerify").removeClass("invalid-feedback");
});

$("#uploadLogo").on("change", function () {
    var file = $(this)[0].files[0];

    if (file && file.type.startsWith("image")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#uploadedLogo")[0].src = e.target.result;
            $("#uploadedLogo").css("display", "block");
        };
        reader.readAsDataURL(file);
    } else {
        Toast.fire({
            icon: "warning",
            title: "Yang diupload harus image!",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            toast: true,
            position: "top-end",
        });
    }
});

$(".fotoProfile").on("click", function () {
    const urlImg = $(this).data("url-img");
    $(".urlShowProfilImg").attr("src", urlImg);
    $("#gambarModal").modal("show");
});

$(".logoApp").on("click", function () {
    const urlLogo = $(this).data("url-logo");
    $(".urlShowLogoApp").attr("src", urlLogo);
    $("#logoModal").modal("show");
});
