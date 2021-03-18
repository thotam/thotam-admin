import "datatables.net/js/jquery.dataTables.js";
import "datatables.net-bs4/js/dataTables.bootstrap4.js";
import "datatables.net-buttons/js/dataTables.buttons.js";
import "datatables.net-buttons-bs4/js/buttons.bootstrap4.js";
import "datatables.net-buttons/js/buttons.flash.js";
import "datatables.net-buttons/js/buttons.html5.js";
import "datatables.net-buttons/js/buttons.print.js";

window.JSZip = require("jszip");

var pdfMake = require("pdfmake/build/pdfmake.js");
var pdfFonts = require("pdfmake/build/vfs_fonts.js");
pdfMake.vfs = pdfFonts.pdfMake.vfs;
