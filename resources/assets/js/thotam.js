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
