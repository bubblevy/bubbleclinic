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
const flashMessage = $(".flash-data").data("flash-message");
const flashAksi = $(".flash-data").data("flashaksi");
const flashTipe = $(".flash-data").data("flashtipe");
if (flashMessage) {
    Toast.fire({
        icon: flashTipe,
        title: flashMessage + " " + flashAksi,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        toast: true,
        position: "top-end",
    });
}

$("#username").on("input", function () {
    let username = $(this).val();
    $(this).val(
        username
            .replace(/\s/g, "")
            .replace(/[^a-zA-Z0-9]/g, "")
            .toLowerCase()
    );
});

$("#namaLengkap").on("input", function () {
    let nama = $(this).val();
    var lettersAndSpace = /^[a-zA-Z\s]*$/; // RegEx untuk huruf dan spasi

    if (!nama.match(lettersAndSpace)) {
        let namaClear = nama.replace(/[^a-zA-Z\s]/g, "");
        $(this).val(namaClear);
    }
});

$("#password").on("input", function () {
    let password = $(this).val();
    $(this).val(password.trim());
});
$("#email").on("input", function () {
    let email = $(this).val();
    $(this).val(email.toLowerCase().trim().replace(/\s/g, ""));
});

$("#username, #password, #email, #namaLengkap, #password2").on(
    "keyup",
    function () {
        if ($("#username").val() !== "") {
            if ($("#password").val() !== "") {
                if ($("#email").val() !== "") {
                    if ($("#namaLengkap").val() !== "") {
                        if ($("#password2").val() !== "") {
                            $(".tombolDaftar").removeClass("disabled");
                            $(".divBtn").removeAttr("style");
                        } else {
                            $(".tombolDaftar").addClass("disabled", true);
                            $(".divBtn").attr("style", "cursor: not-allowed;");
                        }
                    } else {
                        $(".tombolDaftar").addClass("disabled", true);
                        $(".divBtn").attr("style", "cursor: not-allowed;");
                    }
                } else {
                    $(".tombolDaftar").addClass("disabled", true);
                    $(".divBtn").attr("style", "cursor: not-allowed;");
                }
            } else {
                $(".tombolDaftar").addClass("disabled", true);
                $(".divBtn").attr("style", "cursor: not-allowed;");
            }
        } else {
            $(".tombolDaftar").addClass("disabled", true);
            $(".divBtn").attr("style", "cursor: not-allowed;");
        }
    }
);
