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

function setMessage(message, status) {
    Toast.fire({
        icon: status,
        title: message,
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        toast: true,
        position: "top-end",
    });
}

$("#dateStart").on("change", function () {
    const data = $(this).val();
    const enddata = $("#endDate").val();
    if (enddata) {
        window.location.href =
            "/admin/pasien/filter?startDate=" + data + "&endDate=" + enddata;
    } else {
        window.location.href = "/admin/pasien/filter?startDate=" + data;
    }
});

$("#endDate").on("change", function () {
    const data = $("#dateStart").val();
    const enddata = $(this).val();
    if (data) {
        window.location.href =
            "/admin/pasien/filter?startDate=" + data + "&endDate=" + enddata;
    } else {
        $(this).val("");
        setMessage("Masukkan tanggal awal dulu!", "warning");
    }
});

// delete patient
$(".buttonDeletePatient").on("click", function () {
    const code = $(this).data("code");
    const name = $(this).data("name");
    $("#codeDeletePatient").val(code);
    $(".namaPatientDelete").html(
        "Delete pasien atas nama <strong>" + name + "</strong> ?"
    );
    $("#deletePatient").modal("show");
});

// edit patient
$(".buttonEditPatient").on("click", function () {
    const code = $(this).data("code");
    const name = $(this).data("name");
    const address = $(this).data("address");
    const old = $(this).data("old");
    const gender = $(this).data("gender");
    $("#codeEditPatient").val(code);
    $("#nama_lengkap_patient").val(name);
    $("#address").val(address);
    $("#old").val(old);
    gender == "Laki-Laki"
        ? $("#gender_patient #laki-laki").attr("selected", true)
        : $("#gender_patient #perempuan").attr("selected", true);
    $("#formModalAdminEditPatient").modal("show");
});

$(".cancelModalEditPatient").on("click", function () {
    $(".modalAdminEditPatient")[0].reset();
    $(
        "#formModalAdminEditPatient #nama_lengkap_patient, #formModalAdminEditPatient #address, #formModalAdminEditPatient #old, #formModalAdminEditPatient #gender"
    ).removeClass("is-invalid");
    $(
        "#formModalAdminEditPatient #nama_lengkap_patient, #formModalAdminEditPatient #address, #formModalAdminEditPatient #old, #formModalAdminEditPatient #gender_patient"
    ).removeClass("invalid-feedback");
});
