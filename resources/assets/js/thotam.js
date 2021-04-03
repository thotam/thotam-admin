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

    Livewire.hook("message.processed", (message, component) => {});
});
