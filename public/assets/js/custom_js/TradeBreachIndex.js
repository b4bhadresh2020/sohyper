function detailInit(e) {
    var detailRow = e.detailRow;
    detailRow.find(".commentDetails").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: "rejects_comment_list" + "/" +
                        e.data.commentId,
                    dataType: "json",
                    type: "GET",
                }
            },
            pageSize: 5,
            serverFiltering: true,
        },
        pageable: {
            refresh: true,
            pageSizes: true
        },
        scrollable: false,
        sortable: true,
        pageable: true,
        columns: [{
                field: "comment",
                title: "Comments",
                width: "70px"
            },
            {
                field: "commentedBy",
                title: "Commented By",
                width: "30px"
            },
            {
                field: "commentDate",
                title: "Commented Date",
                width: "30px"
            },
            {
                field: "commentTime",
                title: "Commented Time",
                width: "30px"
            }
        ]
    });
}
function TradeRiskListData()
{
    var categoriesElement = jQuery("#customerPostionGrid").kendoGrid({
        dataSource: {
            pageSize: 20,
            group: [ { field: "start_date", dir: "asc" }, { field: "customer_name", dir: "asc" } ],
            /*group: {
                field: "entry_date",
                dir: "asc"
            },*/
            transport: {
                read: {
                    url: "trade_risk_list" + "/" +
                        localStorage.getItem('filtedDefaultId'),
                    dataType: "json",
                    type: "GET",
                },
            },
            schema: {
                model: {
                    fields: {
                        account_code_long: {
                            editable: false
                        },
                        asset_code: {
                            editable: false
                        },
                        trade_exposure: {
                            editable: false
                        },
                        settlement_limit: {
                            editable: false
                        },
                        trade_limit: {
                            editable: false
                        }
                    }
                },
            },
            serverFiltering: true,
        },
        pageable: {
            refresh: true,
            pageSizes: true
        },
        autoSync: true,
        sortable: true,
        reorderable: true,
        serverFiltering: true,
        groupable: true,
        resizable: false,
        //toolbar: kendo.template(jQuery("#templates").html()),
        //detailTemplate: kendo.template($("#templateDetail").html()),
        //detailInit: detailInit,
        editable: true,
        scrollable: {
            horizontal: true
        },/*
        dataBound: function(e) {
            var data = this.dataSource.data();
            $.each(data, function(i, row) {
                var commentDetails = row.get("comment");
                if (commentDetails != '') {
                    $('tr[data-uid="' + row.uid + '"] td:nth-child(2)').css("background-color", "lightblue");
                }
            });
            var dataSource = this.dataSource;
            this.element.find('tr.k-master-row').each(function() {
                var row = $(this);
                var data = dataSource.getByUid(row.data('uid'));
                if (data.comment == '') {
                    row.find('.k-hierarchy-cell a').remove();
                }
            });
            var data = this.dataSource.data();
            $.each(data, function(i, row) {
                var statusFontColor = row.get("statusFontColor");
                var colorCode = row.get("colorCode");
                var element = $('tr[data-uid="' + row.uid + '"] ');
                element.css("background-color", colorCode);
                element.css("color", statusFontColor);
            });
        },*/
        columns: [/*{
            field: "entry_date",
            title: "<input name='toggleAll' title='Select or deselect all' onclick='approveRejectValueCheck(this);' type='checkbox'>",
            title: "Entry Date",
            width: 80,
            sortable: false,
            template: kendo.template('#if(statusName == "Pending"){# <input id="cbQ#=approval_id#" name="cbQ[]" type="checkbox" value="#=approval_id#" onClick="approvalRejectCheck(this.checked);" /> #}else{# #}#'),
        },*/ 
        {
            field: "entry_date",
            title: "Date",
            hidden: true,
            groupHeaderTemplate : "#= value #",
        },
        {
            field: "customer_name",
            title: "Name",
            hidden: true,
            groupHeaderTemplate : "#= value #",
        },
        {
            field: "account_code_long",
            title: "Acount",
            width: 80
        }, {
            field: "asset_code",
            title: "Asset",
            width: 50
        }, {
            field: "trade_exposure",
            title: "Trade Exposure",
            width: 100
        }, {
            field: "settlement_limit",
            title: "Settlement Limit",
            width: 100
        }, {
            field: "trade_limit",
            title: "Trade Limit",
            width: 120
        }],
    });
}