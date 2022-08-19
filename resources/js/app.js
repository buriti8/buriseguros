require("./bootstrap");
require("./datetimeutils");
require('select2');

import * as utils from "./utils";

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });
});

$(".btn-delete").click(ev => {
    utils.confirmDelete().then(result => {
        if (result) {
            ev.currentTarget.form.submit();
        }
    });
});

$(".btn-status").click(ev => {
    utils.confirmStatus().then(result => {
        if (result) {
            ev.currentTarget.form.submit();
        }
    });
});

$(".btn-inactive").click(ev => {
    utils.confirmInactive().then(result => {
        if (result) {
            ev.currentTarget.form.submit();
        }
    });
});

$('#output_weight').keyup((e) => {
    let btn = $('#btn_output_weight');
    if($(e.currentTarget).val() == ''){
        console.log('Desabiliraer');
        btn.prop("disabled", 'disabled');
    } else {
        btn.prop("disabled", false);
    }
});

$('#frm_output_weight').submit((ev) => {
    ev.preventDefault();
    ev.currentTarget.submit();
});

$(".btn-exit").click(ev => {
    let vehicle_id = $(ev.currentTarget).data('vehicle');
    let register_id = $(ev.currentTarget).data('register_id');
    
    if (vehicle_id != 1 && vehicle_id != 2 && vehicle_id != 6) {
        let modal = $('#modal_output_weight');
        var url_action = $('#frm_output_weight').prop('action');
        url_action = url_action.replace('$id$', register_id);
        $('#frm_output_weight').prop('action', url_action);
        modal.modal();
    } else {
        utils.confirmExit().then(result => {
            if (result) {
                ev.currentTarget.form.submit();
            }
        });
    }
});

$(".upper").bind("input", function () {
    this.value = this.value.toUpperCase();
});

$(".custom-file-input").on("change", function () {
    let fileName = $(this)
        .val()
        .split("\\")
        .pop();
    $(this)
        .next(".custom-file-label")
        .addClass("selected")
        .html(fileName);
});

$('form').submit(function () {
    $(this).find("button[type='submit']").prop('disabled', true);
});