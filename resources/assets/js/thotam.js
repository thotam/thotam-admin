var isRtl = $("html").attr("dir") === "rtl";

function ThoTam_BlockUI() {
    $.blockUI({
        message:
            '<div class="sk-fold sk-primary mx-auto mb-4"><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div></div><h5 class="text-primary">Đang xử lý...</h5>',
        css: {
            backgroundColor: "transparent",
            border: "0",
            zIndex: 9999999,
        },
        overlayCSS: {
            backgroundColor: "#fff",
            opacity: 0.6,
            zIndex: 9999990,
        },
        centerX: true,
        centerY: true,
        onBlock: function () {
            $("div.blockUI.blockMsg.blockPage").css(
                "top",
                "calc(50% - " +
                    $("div.blockUI.blockMsg.blockPage").height() / 2 +
                    "px )"
            );

            $("div.blockUI.blockMsg.blockPage").css(
                "left",
                "calc(50% - " +
                    $("div.blockUI.blockMsg.blockPage").width() / 2 +
                    "px )"
            );
        },
    });
}

function ThoTam_File_Upload_BlockUI() {
    $.blockUI({
        message:
            '<div class="bg-white p-5"><div class="sk-fold sk-primary mx-auto mb-4"><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div><div class="sk-fold-cube"></div></div><div id="TT_blockUI_custom" class="my-3"></div><h5 class="text-primary">Đang xử lý...</h5></div>',
        css: {
            backgroundColor: "transparent",
            border: "0",
            zIndex: 9999999,
        },
        overlayCSS: {
            backgroundColor: "#fff",
            opacity: 0.6,
            zIndex: 9999990,
        },
        centerX: true,
        centerY: true,
        onBlock: function () {
            $("div.blockUI.blockMsg.blockPage").css(
                "top",
                "calc(50% - " +
                    $("div.blockUI.blockMsg.blockPage").height() / 2 +
                    "px )"
            );

            $("div.blockUI.blockMsg.blockPage").css(
                "left",
                "calc(50% - " +
                    $("div.blockUI.blockMsg.blockPage").width() / 2 +
                    "px )"
            );
        },
    });
}

$(window).on("resize", function () {
    if ($("[thotam-table]").length != 0) {
        $("[thotam-table]").DataTable().columns.adjust();
    }

    $("div.blockUI.blockMsg.blockPage").css(
        "top",
        "calc(50% - " +
            $("div.blockUI.blockMsg.blockPage").height() / 2 +
            "px )"
    );

    $("div.blockUI.blockMsg.blockPage").css(
        "left",
        "calc(50% - " + $("div.blockUI.blockMsg.blockPage").width() / 2 + "px )"
    );

    $("div.blockUI.blockMsg.blockElement").css(
        "top",
        "calc(50% - " +
            $("div.blockUI.blockMsg.blockElement").height() / 2 +
            "px )"
    );

    $("div.blockUI.blockMsg.blockElement").css(
        "left",
        "calc(50% - " +
            $("div.blockUI.blockMsg.blockElement").width() / 2 +
            "px )"
    );
});

$(document).on("click", "[thotam-file-upload-blockui]", function () {
    ThoTam_File_Upload_BlockUI();
});

$(document).on("click", "[thotam-blockui]", function () {
    ThoTam_BlockUI();
});

//Ẩn toàn bộ modal
window.addEventListener("hide_modals", function (e) {
    $(".modal.fade").modal("hide");
});

//Ản modal cụ thể
window.addEventListener("hide_modal", (event) => {
    $(event.detail).modal("hide");
});

//Hiện modal cụ thể
window.addEventListener("show_modal", (event) => {
    $(event.detail).modal("show");
});

//$.blockUI();
window.addEventListener("blockUI", function (e) {
    ThoTam_BlockUI();
});

//$.unblockUI();
window.addEventListener("unblockUI", function (e) {
    $.unblockUI();
});

//Toastr thông báo
window.addEventListener("toastr", (event) => {
    toastr[event.detail.type](event.detail.message, event.detail.title, {
        positionClass: "toast-top-right",
        closeButton: true,
        progressBar: true,
        timeOut: 15000,
        extendedTimeOut: 2000,
        preventDuplicates: false,
        newestOnTop: true,
        rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
    });
});

//Gọi livewire method
$(document).on("click", "[thotam-livewire-method]", function () {
    ThoTam_BlockUI();
    Livewire.emit(
        $(this).attr("thotam-livewire-method"),
        $(this).attr("thotam-model-id")
    );
});

window.addEventListener("livewire-upload-start", (event) => {
    let fime_names = [];
    Livewire.emit(
        "Update_ThotamFileUploadStep",
        $(event.target).attr("wire:model"),
        1
    );
    for (let i = 0; i < $(event.target.files).length; i++) {
        fime_names.push(event.target.files[i].name);
    }

    if (
        $("div#TT_blockUI_custom").find(
            "div.progress-bar." + $(event.target).attr("wire:model")
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<div class="progress"><div class="progress-bar ' +
                $(event.target).attr("wire:model") +
                ' progress-bar-striped bg-info" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny file-upload-name">' +
                fime_names.join("<br>") +
                "</div>"
        );
    } else {
        $("div#TT_blockUI_custom")
            .find("div.progress-bar." + $(event.target).attr("wire:model"))
            .removeClass(
                "bg-info bg-warning bg-danger bg-success progress-bar-animated"
            )
            .addClass("bg-info")
            .css("width", "100%");
    }

    if (
        $("div#TT_blockUI_custom").find(
            'input[type="hidden"][thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '"]'
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<input type="hidden" thotam-stage="uploading" thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '">'
        );
    } else {
        $("div#TT_blockUI_custom")
            .find(
                'input[type="hidden"][thotam-target="' +
                    $(event.target).attr("thotam-wire:model") +
                    '"]'
            )
            .attr("thotam-stage", "uploading");
    }
});

window.addEventListener("livewire-upload-finish", (event) => {
    let fime_names = [];
    Livewire.emit(
        "Update_ThotamFileUploadStep",
        $(event.target).attr("wire:model"),
        4
    );
    for (let i = 0; i < $(event.target.files).length; i++) {
        fime_names.push(event.target.files[i].name);
    }

    if (
        $("div#TT_blockUI_custom").find(
            "div.progress-bar." + $(event.target).attr("wire:model")
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<div class="progress"><div class="progress-bar ' +
                $(event.target).attr("wire:model") +
                ' progress-bar-striped bg-success" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny file-upload-name">' +
                fime_names.join("<br>") +
                "</div>"
        );
    } else {
        $("div#TT_blockUI_custom")
            .find("div.progress-bar." + $(event.target).attr("wire:model"))
            .removeClass(
                "bg-info bg-warning bg-danger bg-success progress-bar-animated"
            )
            .addClass("bg-success")
            .css("width", "100%");
    }

    if (
        $("div#TT_blockUI_custom").find(
            'input[type="hidden"][thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '"]'
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<input type="hidden" thotam-stage="done" thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '">'
        );
    } else {
        $("div#TT_blockUI_custom")
            .find(
                'input[type="hidden"][thotam-target="' +
                    $(event.target).attr("thotam-wire:model") +
                    '"]'
            )
            .attr("thotam-stage", "done");
    }
});

window.addEventListener("livewire-upload-error", (event) => {
    let fime_names = [];
    Livewire.emit(
        "Update_ThotamFileUploadStep",
        $(event.target).attr("wire:model"),
        3
    );
    for (let i = 0; i < $(event.target.files).length; i++) {
        fime_names.push(event.target.files[i].name);
    }

    if (
        $("div#TT_blockUI_custom").find(
            "div.progress-bar." + $(event.target).attr("wire:model")
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<div class="progress"><div class="progress-bar ' +
                $(event.target).attr("wire:model") +
                ' progress-bar-striped bg-danger" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny file-upload-name">' +
                fime_names.join("<br>") +
                "</div>"
        );
    } else {
        $("div#TT_blockUI_custom")
            .find("div.progress-bar." + $(event.target).attr("wire:model"))
            .removeClass(
                "bg-info bg-warning bg-danger bg-success progress-bar-animated"
            )
            .addClass("bg-danger")
            .css("width", "100%");
    }

    if (
        $("div#TT_blockUI_custom").find(
            'input[type="hidden"][thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '"]'
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<input type="hidden" thotam-stage="fail" thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '">'
        );
    } else {
        $("div#TT_blockUI_custom")
            .find(
                'input[type="hidden"][thotam-target="' +
                    $(event.target).attr("thotam-wire:model") +
                    '"]'
            )
            .attr("thotam-stage", "fail");
    }
});

window.addEventListener("livewire-upload-progress", (event) => {
    let fime_names = [];
    for (let i = 0; i < $(event.target.files).length; i++) {
        fime_names.push(event.target.files[i].name);
    }

    if (
        $("div#TT_blockUI_custom").find(
            "div.progress-bar." + $(event.target).attr("wire:model")
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<div class="progress"><div class="progress-bar ' +
                $(event.target).attr("wire:model") +
                ' progress-bar-striped bg-warning" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny file-upload-name">' +
                fime_names.join("<br>") +
                "</div>"
        );
    } else {
        $("div#TT_blockUI_custom")
            .find("div.progress-bar." + $(event.target).attr("wire:model"))
            .removeClass("bg-info bg-warning bg-danger bg-success")
            .addClass("bg-warning progress-bar-animated")
            .css("width", event.detail.progress + "%");
    }

    if (
        $("div#TT_blockUI_custom").find(
            'input[type="hidden"][thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '"]'
        ).length == 0
    ) {
        $("div#TT_blockUI_custom").append(
            '<input type="hidden" thotam-stage="uploading" thotam-target="' +
                $(event.target).attr("thotam-wire:model") +
                '">'
        );
    } else {
        $("div#TT_blockUI_custom")
            .find(
                'input[type="hidden"][thotam-target="' +
                    $(event.target).attr("thotam-wire:model") +
                    '"]'
            )
            .attr("thotam-stage", "uploading");
    }
});

//Xử lý khi dữ liệu đã được load xong
document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook("message.failed", (message, component) => {
        $.unblockUI();
    });

    Livewire.hook("message.processed", (message, component) => {
        if ($("select.thotam-select2").length != 0) {
            $("select.thotam-select2").each(function (e) {
                $(this)
                    .wrap('<div class="position-relative"></div>')
                    .select2({
                        placeholder: $(this).attr("thotam-placeholder"),
                        minimumResultsForSearch: $(this).attr("thotam-search"),
                        allowClear: !!$(this).attr("thotam-allow-clear"),
                        dropdownParent: $("#" + $(this).attr("id") + "_div"),
                    });
            });
        }

        if ($("select.thotam-select2-multi").length != 0) {
            $("select.thotam-select2-multi").each(function (e) {
                $(this)
                    .wrap('<div class="position-relative"></div>')
                    .select2({
                        placeholder: $(this).attr("thotam-placeholder"),
                        minimumResultsForSearch: $(this).attr("thotam-search"),
                        allowClear: !!$(this).attr("thotam-allow-clear"),
                        dropdownParent: $("#" + $(this).attr("id") + "_div"),
                    });
            });
        }

        if ($("input.thotam-datepicker").length != 0) {
            $("input.thotam-datepicker").each(function (e) {
                $(this).datepicker("update");
            });
        }

        if ($("input.thotam-month-picker").length != 0) {
            $("input.thotam-month-picker").each(function (e) {
                $(this).datepicker("update");
            });
        }

        if ($("input.thotam-datetimepicker").length != 0) {
            $("input.thotam-datetimepicker").each(function (e) {
                $(this).datetimepicker("update");
            });
        }
    });
});

//dynamic_update
window.addEventListener("dynamic_update", function (e) {
    if (!!window.thotam_livewire) {
        if ($("select.thotam-select2").length != 0) {
            $("select.thotam-select2").each(function (e) {
                $(this).on("change", function (e) {
                    window.thotam_livewire.set(
                        $(this).attr("wire:model"),
                        $(this).val()
                    );
                });
            });
        }

        if ($("select.thotam-select2-multi").length != 0) {
            $("select.thotam-select2-multi").each(function (e) {
                $(this).on("select2:close", function (e) {
                    window.thotam_livewire.set(
                        $(this).attr("wire:model"),
                        $(this).val()
                    );
                });
            });
        }

        if ($("input.thotam-datepicker").length != 0) {
            $("input.thotam-datepicker").each(function (e) {
                $(this)
                    .datepicker({
                        language: "vi",
                        autoclose: true,
                        toggleActive: true,
                        todayHighlight: true,
                        todayBtn: "linked",
                        clearBtn: true,
                        maxViewMode: 3,
                        minViewMode: 0,
                        startView: !!$(this).attr("thotam-startview")
                            ? $(this).attr("thotam-startview")
                            : 1,
                        weekStart: 1,
                        format: "dd-mm-yyyy",
                        container: !!$(this).attr("thotam-container")
                            ? "#" + $(this).attr("thotam-container")
                            : "body",
                        orientation: isRtl ? "auto right" : "auto left",
                    })
                    .on("hide", function (e) {
                        window.thotam_livewire.set(
                            $(this).attr("wire:model"),
                            $(this).val()
                        );
                    });
            });
        }

        if ($("input.thotam-month-picker").length != 0) {
            $("input.thotam-month-picker").each(function (e) {
                $(this)
                    .datepicker({
                        language: "vi",
                        autoclose: true,
                        toggleActive: true,
                        todayHighlight: true,
                        todayBtn: "linked",
                        clearBtn:
                            $(this).attr("thotam-clearBtn") == "false"
                                ? false
                                : true,
                        maxViewMode: 3,
                        minViewMode: 1,
                        startView: !!$(this).attr("thotam-startview")
                            ? $(this).attr("thotam-startview")
                            : 1,
                        weekStart: 1,
                        format: "mm-yyyy",
                        container: !!$(this).attr("thotam-container")
                            ? "#" + $(this).attr("thotam-container")
                            : "body",
                        orientation: isRtl ? "auto right" : "auto left",
                    })
                    .on("hide", function (e) {
                        window.thotam_livewire.set(
                            $(this).attr("wire:model"),
                            $(this).val()
                        );
                    });
            });
        }

        if ($("input.thotam-filestyle").length != 0) {
            $("input.thotam-filestyle").each(function (e) {
                $(this).filestyle({
                    placeholder: $(this).attr("thotam-placeholder"),
                    btnClass: $(this).attr("thotam-btnClass"),
                    text: $(this).attr("thotam-text"),
                    htmlIcon: '<span class="fas fa-file mr-2"></span>',
                });
            });
        }

        if ($("input.thotam-datetimepicker").length != 0) {
            $("input.thotam-datetimepicker").each(function (e) {
                $(this)
                    .datetimepicker({
                        format: "dd-mm-yyyy hh:ii",
                        autoclose: true,
                        todayBtn: true,
                        minuteStep: 15,
                        todayHighlight: true,
                        bootcssVer: 4,
                        zIndex: 3050,
                        language: "vi",
                        pickerPosition: "top-left",
                        weekStart: 1,
                    })
                    .on("hide", function (e) {
                        window.thotam_livewire.set(
                            $(this).attr("wire:model"),
                            $(this).val()
                        );
                    });
            });
        }
    }
});

if ($("select.colum_filter_id_single").length != 0) {
    $("select.colum_filter_id_single").each(function (e) {
        $(this)
            .wrap('<div class="position-relative dt-select2"></div>')
            .select2({
                placeholder: $(this).attr("placeholder"),
                minimumResultsForSearch: 6,
                allowClear: false,
                dropdownParent: $("div.card-datatable.table-responsive"),
            });
    });
}

if ($("select.colum_filter_id_multi").length != 0) {
    $("select.colum_filter_id_multi").each(function (e) {
        $(this)
            .wrap('<div class="position-relative dt-select2"></div>')
            .select2({
                placeholder: $(this).attr("placeholder"),
                minimumResultsForSearch: 6,
                allowClear: false,
                dropdownParent: $("div.card-datatable.table-responsive"),
            });
    });
}

$("[thotam-clear-btn]").on("click", function () {
    $("[thotam-clear-target=" + $(this).attr("thotam-clear-btn") + "]").val(
        null
    );

    dt_draw_event_function();
});

$("[thotam_dt_date_range_filter]").on("change", function () {
    dt_draw_event_function();
});

$("[thotam_dt_colum_filter]").on("change", function () {
    dt_draw_event_function();
});

$("[thotam_dt_clear_button]").on("click", function () {
    $($(this).attr("thotam_dt_clear_button")).val(null);
    dt_draw_event_function();
});

function dt_draw_event_function() {
    var dt_draw_event; // The custom event that will be created
    if (document.createEvent) {
        dt_draw_event = document.createEvent("HTMLEvents");
        dt_draw_event.initEvent("dt_draw", true, true);
        dt_draw_event.eventName = "dt_draw";
        window.dispatchEvent(dt_draw_event);
    } else {
        dt_draw_event = document.createEventObject();
        dt_draw_event.eventName = "dt_draw";
        dt_draw_event.eventType = "dt_draw";
        window.fireEvent("on" + dt_draw_event.eventType, dt_draw_event);
    }
}

if (typeof Handlebars == "object") {
    Handlebars.registerHelper("month_mY", function (aString) {
        return moment(aString).format("MM-YYYY");
    });

    Handlebars.registerHelper("month_dmYHi", function (aString) {
        return moment(aString).format("DD-MM-YYYY HH:mm");
    });
}

//blueimp-carousel-poster
function TT_BlueimpCarousel() {
    $("[thotam-id='blueimp-carousel']").each(function (e) {
        var blue_data = [];

        $(this)
            .find("[thotam-blueimp-carousel]")
            .each(function (e) {
                blue_data.push({
                    type: $(this).attr("mine-type"),
                    href: $(this).attr("href"),
                    thumbnail: $(this).attr("thumbnail"),
                    poster: $(this).attr("thumbnail"),
                });
            });

        blueimpGallery(blue_data, {
            container: this,
            carousel: true,
        });
    });
}

//plyr
function TT_Plyr() {
    $(".thotam-plyr").each(function (e) {
        new Plyr(this, {
            vimeo: {
                byline: false,
                portrait: false,
                title: false,
                speed: true,
                transparent: false,
                quality: "1080p",
            },
        });
    });
}

$(".modal.fade").on("shown.bs.modal", function () {
    if ($("[thotam-id='blueimp-carousel']").length != 0) {
        setTimeout(function () {
            TT_BlueimpCarousel();
        }, 250);
    }

    if ($(".thotam-plyr").length != 0) {
        setTimeout(function () {
            TT_Plyr();
        }, 100);
    }
});
