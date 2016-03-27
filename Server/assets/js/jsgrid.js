$(function () {
    $("#list").jqGrid({
        url: "includes/Grid/jqGrid.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["Id", "Name", "Email"],
        colModel: [
            { name: "id", index: "id", align: "center" },
            { name: "name", index: "name", align: "center" },
            { name: "email", index: "email", align: "center" }
		],
        pager: "#pager",
        rowNum: 5,
        rowList: [5, 10, 20],
        sortname: "id",
        sortorder: "desc",
        viewrecords: true,
        gridview: true,
        autoencode: true,
		height: 450,
		autowidth: true,
		scroll: true,
        caption: "Grid user",
    }); 
});