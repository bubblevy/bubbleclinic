// confirm patient
$(".buttonConfirmQueuePatient").on("click", function () {
    const code = $(this).data("code");
    const name = $(this).data("name");
    $("#codePatient").val(code);
    $(".namaPatientConfirm").html(
        "Konfirmasi pasien terlambat atas nama <strong>" + name + "</strong> ?"
    );
    $("#confirmQueuePatient").modal("show");
});
