import swal from "sweetalert";

export function confirmDelete() {
    return confirmAlert("Eliminar", "¿Desea eliminar el registro?");
}

export function confirmStatus() {
    return confirmAlert("Confirmación", "¿Desea cambiar el estado?");
}

export function confirmInactive() {
    return confirmAlert("Confirmación", "¿Desea cambiar el estado?");
}

export function confirmExit() {
    return confirmAlert("Confirmación", "¿Desea registrar salida del vehículo?");
}

export function confirmAlert(
    title,
    text,
    confirmText = "ACEPTAR",
    cancelText = "CANCELAR"
) {
    return swal({
        title: title,
        text: text,
        icon: "warning",
        dangerMode: true,
        width: 300,
        buttons: {
            confirm: {
                text: confirmText,
                value: true,
                visible: true,
                className: "",
                closeModal: true
            },
            cancel: {
                text: cancelText,
                value: null,
                visible: true,
                className: "",
                closeModal: true
            }
        }
    });
}
