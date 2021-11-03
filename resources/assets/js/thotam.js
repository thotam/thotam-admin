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
        thotam_rerender();

        $(function () {
            if ($("html").attr("dir") === "rtl") {
                $(".tooltip-demo [data-placement=right]")
                    .attr("data-placement", "left")
                    .addClass("rtled");
                $(".tooltip-demo [data-placement=left]:not(.rtled)")
                    .attr("data-placement", "right")
                    .addClass("rtled");
            }
            $('[data-toggle="tooltip"]').tooltip();

            // Popovers

            if ($("html").attr("dir") === "rtl") {
                $(".popover-demo [data-placement=right]")
                    .attr("data-placement", "left")
                    .addClass("rtled");
                $(".popover-demo [data-placement=left]:not(.rtled)")
                    .attr("data-placement", "right")
                    .addClass("rtled");
            }
            $('[data-toggle="popover"]').popover();
        });

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
                if (!!$(this).attr("thotam-orientation")) {
                    vertical_align = $(this).attr("thotam-orientation");
                } else {
                    vertical_align = "auto";
                }

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
                        orientation: isRtl
                            ? vertical_align + " right"
                            : vertical_align + " left",
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
                if (!!$(this).attr("thotam-icon")) {
                    thotam_icon = $(this).attr("thotam-icon");
                } else {
                    thotam_icon = "fas fa-file";
                }

                $(this).filestyle({
                    placeholder: $(this).attr("thotam-placeholder"),
                    btnClass: $(this).attr("thotam-btnClass"),
                    text: $(this).attr("thotam-text"),
                    htmlIcon: '<span class="' + thotam_icon + ' mr-2"></span>',
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

if ($("input.colum_filter_id_date").length != 0) {
    $("input.colum_filter_id_date").each(function (e) {
        $(this).datepicker({
            language: "vi",
            autoclose: true,
            toggleActive: true,
            todayHighlight: true,
            todayBtn: "linked",
            clearBtn: $(this).attr("thotam-clearBtn") == "false" ? false : true,
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

$("[thotam_dt_date_filter]").on("change", function () {
    dt_draw_event_function();
});

$("[thotam_dt_month_filter]").on("change", function () {
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

    Handlebars.registerHelper("date_dmY", function (aString) {
        return moment(aString).format("DD-MM-YYYY");
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

    thotam_perfect_scrollbar_scroll();
});

//Rerendering when updated
function thotam_rerender() {
    if ($("select[thotam-select2-rerender]").length != 0) {
        $("select[thotam-select2-rerender]").each(function (e) {
            thotam_livewire_id = eval($(this).attr("thotam-livewire-id"));

            if (!!$(this).attr("multiple")) {
                html = "";
            } else {
                html = "<option selected></option>";
            }

            array_data = thotam_livewire_id.get(
                $(this).attr("thotam-select2-rerender")
            );

            array_data.forEach((element) => {
                html +=
                    "<option value='" +
                    element.value +
                    "'>" +
                    element.text +
                    "</option>";
            });

            $(this).html(html);

            $(this).val(thotam_livewire_id.get($(this).attr("wire:model")));

            $(this).trigger("change.select2");
        });
    }

    if ($("input[thotam-datepicker='true']").length != 0) {
        $("input[thotam-datepicker='true']").each(function (e) {
            $(this).datepicker("update");
        });
    }

    if ($("input[thotam-datetimepicker='true']").length != 0) {
        $("input[thotam-datetimepicker='true']").each(function (e) {
            $(this).datetimepicker("update");
        });
    }
}

//Livewire with select2
window.thotam_select2 = function (thotam_el, thotam_livewire_id) {
    setTimeout(function () {
        $(thotam_el).select2({
            placeholder: $(thotam_el).attr("thotam-placeholder"),
            minimumResultsForSearch: $(thotam_el).attr("thotam-search"),
            allowClear: !!$(thotam_el).attr("thotam-allow-clear"),
            dropdownParent: $("#" + $(thotam_el).attr("id") + "_div"),
        });

        if (!!$(thotam_el).attr("multiple")) {
            $(thotam_el).on("select2:close", function (e) {
                thotam_livewire_id.set(
                    $(thotam_el).attr("wire:model"),
                    $(thotam_el).val()
                );
            });
        } else {
            $(thotam_el).on("change", function (e) {
                thotam_livewire_id.set(
                    $(thotam_el).attr("wire:model"),
                    $(thotam_el).val()
                );
            });
        }
    }, 250);
};

//blueimp-carousel-poster
window.thotam_blueimp = function (thotam_el) {
    setTimeout(function () {
        var blue_data = [];

        $(thotam_el)
            .find("[thotam-blueimp-carousel]")
            .each(function (e) {
                if ($(this).attr("mine-type") == "vimeo") {
                    blue_data.push({
                        type: "text/html",
                        href: $(this).attr("href"),
                        thumbnail: $(this).attr("thumbnail"),
                        poster: $(this).attr("thumbnail"),
                        vimeo: $(this).attr("vimeo-id"),
                    });
                } else {
                    blue_data.push({
                        type: $(this).attr("mine-type"),
                        href: $(this).attr("href"),
                        thumbnail: $(this).attr("thumbnail"),
                        poster: $(this).attr("thumbnail"),
                    });
                }
            });

        blueimpGallery(blue_data, {
            container: thotam_el,
            carousel: true,
            fullscreen: false,
            videoPlaysInline: false,
        });
    }, 250);
};

//Livewire with ajax_select2
window.thotam_ajax_select2 = function (
    thotam_el,
    thotam_livewire_id,
    url,
    perPage,
    token
) {
    $(thotam_el).select2({
        placeholder: $(thotam_el).attr("thotam-placeholder"),
        minimumResultsForSearch: $(thotam_el).attr("thotam-search"),
        allowClear: !!$(thotam_el).attr("thotam-allow-clear"),
        dropdownParent: $("#" + $(thotam_el).attr("id") + "_div"),
        ajax: {
            url: url,
            dataType: "json",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": token,
            },
            delay: 1000,
            data: function (params) {
                return {
                    search: params.term, // search term
                    page: params.page || 1,
                    perPage: perPage,
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.data,
                    pagination: {
                        more: params.page * perPage < data.total_count,
                    },
                };
            },
            cache: true,
        },
    });

    if (!!$(thotam_el).attr("multiple")) {
        $(thotam_el).on("select2:close", function (e) {
            thotam_livewire_id.set(
                $(thotam_el).attr("wire:model"),
                $(thotam_el).val()
            );
        });
    } else {
        $(thotam_el).on("change", function (e) {
            thotam_livewire_id.set(
                $(thotam_el).attr("wire:model"),
                $(thotam_el).val()
            );
        });
    }
};

//Livewire with datetimepicker
window.thotam_datetimepicker = function (thotam_el, thotam_livewire_id) {
    $(thotam_el)
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
            thotam_livewire_id.set(
                $(thotam_el).attr("wire:model"),
                $(thotam_el).val()
            );
        });

    $(thotam_el).attr("thotam-datetimepicker", true);
};

//Livewire with datepicker
window.thotam_datepicker = function (
    thotam_el,
    thotam_livewire_id,
    minview = 0,
    startview = 0,
    format = "dd-mm-yyyy"
) {
    if (!!$(thotam_el).attr("thotam-orientation")) {
        vertical_align = $(thotam_el).attr("thotam-orientation");
    } else {
        vertical_align = "auto";
    }

    $(thotam_el)
        .datepicker({
            language: "vi",
            autoclose: true,
            toggleActive: true,
            todayHighlight: true,
            todayBtn: "linked",
            clearBtn: $(this).attr("thotam-clearBtn") == "false" ? false : true,
            maxViewMode: 3,
            minViewMode: minview,
            startView: startview,
            weekStart: 1,
            format: format,
            container: !!$(thotam_el).attr("thotam-container")
                ? "#" + $(thotam_el).attr("thotam-container")
                : "body",
            orientation: isRtl
                ? vertical_align + " right"
                : vertical_align + " left",
        })
        .on("hide", function (e) {
            thotam_livewire_id.set(
                $(thotam_el).attr("wire:model"),
                $(thotam_el).val()
            );
        });

    $(thotam_el).attr("thotam-datepicker", true);
};

//Livewire with filestyle
window.thotam_filestyle = function (thotam_el, thotam_icon = "fas fa-file") {
    $(thotam_el).filestyle({
        placeholder: $(thotam_el).attr("thotam-placeholder"),
        btnClass: $(thotam_el).attr("thotam-btnClass"),
        text: $(thotam_el).attr("thotam-text"),
        htmlIcon: '<span class="' + thotam_icon + ' mr-2"></span>',
    });
};

//inputSpinner
window.input_spinner = function (thotam_el, buttonsClass = null) {
    $(thotam_el).inputSpinner({
        buttonsClass: !!buttonsClass ? buttonsClass : "btn-outline-secondary",
    });
};

//Livewire with perfect_scrollbar
window.thotam_perfect_scrollbar = function (thotam_el) {
    new PerfectScrollbar(thotam_el, {
        suppressScrollX: true,
        wheelPropagation: true,
    });
};

window.thotam_perfect_scrollbar_scroll = function () {
    $(".chat-scroll").each(function () {
        var this_scroll = this;
        setTimeout(function () {
            this_scroll.scrollTop =
                this_scroll.scrollHeight - this_scroll.clientHeight;
        }, 300);
    });
};

//thotam_gallery lightGallery
window.thotam_gallery = function (element) {
    const inlineGallery = lightGallery(
        $(element).children("[thotam-gallery-data]")[0],
        {
            hash: false,
            licenseKey: "B27E0AC6-68224C21-9D2C4A8F-42E0CF0B",
            closable: false,
            download: false,
            flipHorizontal: false,
            flipVertical: false,
            zoom: true,
            slideShowInterval: 10000,
            slideShowAutoplay:
                !!$(element).attr("thotam-slideShowAutoplay") &&
                $(element).attr("thotam-slideShowAutoplay") == "true"
                    ? true
                    : false,
            videoMaxSize: "1920-1080",
            fullScreen:
                !!$(element).attr("thotam-fullScreen") &&
                $(element).attr("thotam-fullScreen") == "true"
                    ? true
                    : false,
            showMaximizeIcon: true,
            autoplayFirstVideo: false,
            container: $(element),
            plugins: [
                lgVideo,
                lgZoom,
                lgThumbnail,
                lgFullscreen,
                lgAutoplay,
                lgRotate,
            ],
            thumbWidth: 60,
            thumbHeight: "40px",
            thumbMargin: 4,
            height: "100px",
            vimeoPlayerParams: {
                muted: false,
            },
        }
    );

    setTimeout(() => {
        inlineGallery.openGallery();
    }, 200);

    var __trigger = false;
    $(element)
        .children("[thotam-gallery-data]")[0]
        .addEventListener("lgContainerResize", (event) => {
            if (inlineGallery.$container.hasClass("lg-inline")) {
                if (
                    $(inlineGallery.$container.selector)
                        .closest("div.modal-dialog.modal-dialog-centered")
                        .hasClass("inline-gallery-maximize")
                ) {
                    $(inlineGallery.$container.selector)
                        .closest("div.modal-dialog.modal-dialog-centered")
                        .removeClass("inline-gallery-maximize");
                    if (__trigger) {
                        __trigger = !__trigger;
                        setTimeout(() => {
                            //window.dispatchEvent(new Event("resize"));
                        }, 200);
                    }
                }
            } else {
                if (
                    !$(inlineGallery.$container.selector)
                        .closest("div.modal-dialog.modal-dialog-centered")
                        .hasClass("inline-gallery-maximize")
                ) {
                    $(inlineGallery.$container.selector)
                        .closest("div.modal-dialog.modal-dialog-centered")
                        .addClass("inline-gallery-maximize");
                    if (!__trigger) {
                        __trigger = !__trigger;
                        setTimeout(() => {
                            //window.dispatchEvent(new Event("resize"));
                        }, 200);
                    }
                }
            }
        });
};

//Livewire with ckeditor
window.thotam_ckeditor = function (thotam_el, thotam_dispatch) {
    ClassicEditor.create(thotam_el, {
        removePlugins: ["Title"],

        toolbar: {
            items: [
                "heading",
                "|",
                "bold",
                "italic",
                "underline",
                "strikethrough",
                "link",
                "subscript",
                "superscript",
                "bulletedList",
                "numberedList",
                "|",
                "alignment",
                "fontFamily",
                "fontSize",
                "fontColor",
                "fontBackgroundColor",
                "highlight",
                "|",
                "indent",
                "outdent",
                "|",
                //"imageUpload",
                "blockQuote",
                "insertTable",
                "mediaEmbed",
                "code",
                "codeBlock",
                "horizontalLine",
                //"MathType",
                //"ChemType",
                "specialCharacters",
                //"todoList",
                //"pageBreak",
                "|",
                "undo",
                "redo",
                "removeFormat",
                //"|",
                //"exportPdf"
            ],
        },
        language: "vi",
        image: {
            toolbar: [
                "imageTextAlternative",
                "imageStyle:full",
                "imageStyle:side",
            ],
        },
        table: {
            contentToolbar: [
                "tableColumn",
                "tableRow",
                "mergeTableCells",
                "tableCellProperties",
                "tableProperties",
            ],
            tableProperties: {
                // ...
            },
            // Configuration of the TableCellProperties plugin.
            tableCellProperties: {
                // ...
            },
        },
        licenseKey: "",
    })
        .then(function (editor) {
            editor.model.document.on("change:data", () => {
                thotam_dispatch("input", editor.getData());
            });
        })
        .catch((error) => {
            console.error(error);
        });
};

$.fn.modal.Constructor.prototype._enforceFocus = function () {
    $(document)
        .off("focusin.bs.modal")
        .on(
            "focusin.bs.modal",
            function (e) {
                if (
                    typeof this.$element !== "undefined" &&
                    this.$element[0] !== e.target &&
                    !this.$element.has(e.target).length &&
                    !$(e.target).closest(".cke_dialog, .cke").length
                ) {
                    this.$element.trigger("focus");
                }
            }.bind(this)
        );
};

//Livewire with file_pond
if (typeof FilePond !== "undefined" && FilePond !== null) {
    FilePond.registerPlugin(FilePondPluginFileValidateType);
}

window.thotam_file_pond = function (
    thotam_el,
    url,
    token,
    thotam_livewire_id,
    menthod,
    max_file = null
) {
    const TT_FilePond = FilePond.create(thotam_el, {
        server: {
            url: url,
            headers: {
                "X-CSRF-TOKEN": token,
            },
        },
        maxFiles: max_file,
        chunkUploads: true,
        chunkForce: true,
        chunkSize: 10485760,
        credits: {
            label: "CPC1 Hà Nội",
            url: "https://cpc1hn.com.vn/",
        },
        onupdatefiles: function (file) {
            isLoadingCheck(TT_FilePond, thotam_el, menthod, thotam_livewire_id);
        },
        onprocessfiles() {
            isLoadingCheck(TT_FilePond, thotam_el, menthod, thotam_livewire_id);
        },
        onaddfilestart() {
            thotam_livewire_id.set("FilePondHasUpload", true);
        },
        onerror() {
            thotam_livewire_id.set("FilePondHasUploadError", true);
            $.unblockUI();
        },
    });
};

function isLoadingCheck(TT_FilePond, thotam_el, menthod, thotam_livewire_id) {
    var isLoading =
        TT_FilePond.getFiles().filter((x) => x.status !== 5).length !== 0;

    if (!isLoading) {
        thotam_livewire_id.set("FilePondHasUploadError", false);
        Livewire.emit(
            "FilePondUploadDone",
            $(thotam_el).attr("name"),
            TT_FilePond.getFiles().map((x) => x.serverId),
            !!$(thotam_el).attr("multiple"),
            menthod
        );
    }
}

//Livewire with currency
window.thotam_currency = function (thotam_el, thotam_livewire_id) {
    $(thotam_el)
        .on("blur", function () {
            $(this).formatCurrency({
                colorize: true,
                region: "vi-VN",
                roundToDecimalPlace: 0,
            });
        })
        .on("keyup", function () {
            var e = window.event || e;
            var keyUnicode = e.charCode || e.keyCode;
            if (e !== undefined) {
                switch (keyUnicode) {
                    case 16:
                        break; // Shift
                    case 27:
                        this.value = "";
                        break; // Esc: clear entry
                    case 35:
                        break; // End
                    case 36:
                        break; // Home
                    case 37:
                        break; // cursor left
                    case 38:
                        break; // cursor up
                    case 39:
                        break; // cursor right
                    case 40:
                        break; // cursor down
                    case 78:
                        break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
                    case 110:
                        break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
                    case 190:
                        break; // .
                    default:
                        $(this).formatCurrency({
                            colorize: true,
                            region: "vi-VN",
                            roundToDecimalPlace: -1,
                            eventOnDecimalsEntered: true,
                        });
                }
            }
        })
        .on("change", function () {
            thotam_livewire_id.set(
                $(thotam_el).attr("thotam:model"),
                $(thotam_el).val()
            );
        });
};
