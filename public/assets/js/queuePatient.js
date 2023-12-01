$("#old").on("input", function () {
    let old = $(this).val();
    $(this).val(old.replace(/\D/g, ""));
});
// confirm patient
$(".buttonConfirmQueuePatient").on("click", function () {
    const code = $(this).data("code");
    const name = $(this).data("name");
    $("#codePatient").val(code);
    $(".namaPatientConfirm").html(
        "Konfirmasi pasien atas nama <strong>" + name + "</strong> ?"
    );
    $("#confirmQueuePatient").modal("show");
});

// skip patient
$(".buttonSkipQueuePatient").on("click", function () {
    const code = $(this).data("code");
    const name = $(this).data("name");
    $("#codeSkipPatient").val(code);
    $(".namaPatientSkip").html(
        "Lewati pasien atas nama <strong>" +
            name +
            "</strong> ? Data akan <strong>dipindahkan</strong> ke antrian pasien terlambat!"
    );
    $("#skipQueuePatient").modal("show");
});

$(".cancelModalTakePatientQueue").on("click", function () {
    $(".modalAdminAddPatientQueue")[0].reset();
    $(
        "#formModalAdminAddPatientQueue #nama_lengkap_patient, #formModalAdminAddPatientQueue #address, #formModalAdminAddPatientQueue #old, #formModalAdminAddPatientQueue #gender"
    ).removeClass("is-invalid");
    $(
        "#formModalAdminAddPatientQueue #nama_lengkap_patient, #formModalAdminAddPatientQueue #address, #formModalAdminAddPatientQueue #old, #formModalAdminAddPatientQueue #gender_patient"
    ).removeClass("invalid-feedback");
    $(
        "#formModalAdminAddPatientQueue #nama_lengkap_patient, #formModalAdminAddPatientQueue #address, #formModalAdminAddPatientQueue #old, #formModalAdminAddPatientQueue #gender_patient"
    ).val("");
});
