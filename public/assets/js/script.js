$(function () {
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

    const statusVerify = $(".statusverify").data("status-verify-success");
    const statusVerifyFailed = $(".statusverify").data("status-verify-failed");
    const usernameRequired = $(".validateMessages").data("username-required");
    const passwordRequired = $(".validateMessages").data("password-required");
    if (statusVerify) {
        $("#formModalUsersSetEmail").modal("show");
    }
    if (statusVerifyFailed) {
        $("#formModalUsersEditEmail").modal("show");
    }
    if (usernameRequired || passwordRequired) {
        $("#formModalUsersEditEmail").modal("show");
    }

    // notif berhasil update email
    const updateEmailSuccess = $(".statusUpdateEmail").data(
        "update-email-success"
    );
    if (updateEmailSuccess) {
        setMessage(updateEmailSuccess, "success");
    }

    const validatedEmail = $(".validatedEmail").data("email");
    if (validatedEmail) {
        $("#formModalUsersSetEmail").modal("show");
    }

    // notif update information user & admin
    const infoUpdateSettings = $(".infoupdate").data("user-updated");
    if (infoUpdateSettings) {
        setMessage(infoUpdateSettings, "success");
    }

    // update password user & admin
    const passLamaFailed = $(".infoupdatepass").data("pass-lama-failed");
    const updatedPass = $(".infoupdatepass").data("updated-pass");
    if (updatedPass) {
        setMessage(updatedPass, "success");
    }
    if (passLamaFailed) {
        setMessage(passLamaFailed, "error");
    }

    //update app admin
    const updatedApp = $(".infoupdate").data("update-app");
    if (updatedApp) {
        setMessage(updatedApp, "success");
    }

    // notification antrian berhasil. antrian confirm, antrian delete
    const ambilAntrianSuccess = $(".flash-message").data(
        "flash-message-antrian"
    );
    const confirmPatientSuccess = $(".flash-message").data("confirm-patient");
    const deletePatientSuccess = $(".flash-message").data("delete-patient");
    const skipPatientSuccess = $(".flash-message").data("skip-patient");
    if (ambilAntrianSuccess) {
        setMessage(ambilAntrianSuccess, "success");
    }
    if (confirmPatientSuccess) {
        setMessage(confirmPatientSuccess, "success");
    }
    if (deletePatientSuccess) {
        setMessage(deletePatientSuccess, "success");
    }
    if (skipPatientSuccess) {
        setMessage(skipPatientSuccess, "success");
    }

    // edit patient
    const editPatientSuccess = $(".flash-message").data("edit-patient");
    if (editPatientSuccess) {
        setMessage(editPatientSuccess, "success");
    }

    // error if edit patient
    const errorEditName = $(".edit-error-validate").data("error-name");
    const errorEditAddress = $(".edit-error-validate").data("error-address");
    const errorEditOld = $(".edit-error-validate").data("error-old");
    const errorEditGender = $(".edit-error-validate").data("error-gender");
    if (errorEditName || errorEditAddress || errorEditOld || errorEditGender) {
        $("#formModalAdminEditPatient").modal("show");
    }

    // klinik tutup
    const errorCloseTime = $(".flash-message").data("close-time");
    if (errorCloseTime) {
        setMessage(errorCloseTime, "info");
    }

    // error if take antrian
    const errorNameTakeAntrian = $(".error-validate").data("error-name");
    const errorAddressTakeAntrian = $(".error-validate").data("error-address");
    const errorOldTakeAntrian = $(".error-validate").data("error-old");
    const errorGenderTakeAntrian = $(".error-validate").data("error-gender");
    if (
        errorNameTakeAntrian ||
        errorAddressTakeAntrian ||
        errorOldTakeAntrian ||
        errorGenderTakeAntrian
    ) {
        $("#formModalAdminAddPatientQueue").modal("show");
    }
});
