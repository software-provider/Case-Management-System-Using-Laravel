$(window).on('load', function(){
    var tableStructure = {
        sellerList: [{
                field: 'id',
                title: 'ID',
                sortable: true,
                footerFormatter: 'Total'
            }, {
                field: 'name',
                title: 'Name',
                sortable: true
            }, {
                field: 'doe',
                title: 'DOE',
                sortable: true
            }, {
                field: 'total_amount_frozen',
                title: 'Total Amount Frozen',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'units_sold',
                title: 'Units Sold',
                sortable: true,
                valign: 'middle',
                footerFormatter: totalCountFormatter
            }, {
                field: 'product_gmv',
                title: 'Product GMV (Wish)',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'amount_frozen_usd',
                title: 'Amount Frozen USD',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'amount_frozen_cny',
                title: 'Amount frozen CNY',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'marketplace.marketplace_name',
                title: 'Marketplace',
                sortable: true
            }, {
                field: 'linked_case.id',
                title: 'Linked Case',
                formatter: function(value, row, index) {
                    return '<a href="javascript:void(0)">Case #'+ value +'</a>';
                },
                sortable: true,
                events: {
                    'click a': function (e, value, row, index) {
                        caseDetailsFormatter(row.linked_case);
                    }
                },
                clickToSelect: false
            }, {
                field: 'product_url',
                title: 'Product Url',
                sortable: true,
                formatter: function (value, row, index) {
                    return '<a target="_blank" href="'+ value +'">'+ value +'</a>';
                }
            }, {
                field: 'store_url',
                title: 'Store Url',
                sortable: true,
                formatter: function (value, row, index) {
                    return '<a target="_blank" href="'+ value +'">'+ value +'</a>';
                }
            }, {
                field: 'created_at',
                title: 'Created At',
                sortable: true,
                formatter: dateTimeFormatter
            }, {
                field: 'updated_at',
                title: 'Updated At',
                sortable: true,
                formatter: dateTimeFormatter
            }],
        settlementList: [{
                field: 'id',
                title: 'ID',
                sortable: true,
                footerFormatter: 'Average'
            }, {
                field: 'linked_case',
                title: 'Case Number',
                sortable: true,
                formatter: function (value, row, index) {
                    return '<a href="javascript:void(0)">Case #'+ value.id +'</a>';
                },
                events: {
                    'click a': function (e, value, row, index) {
                        caseDetailsFormatter(row.linked_case);
                    }
                },
                clickToSelect: false
            }, {
                field: 'offered_amount',
                title: 'Offered Amount',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: averagePriceFormatter
            }, {
                field: 'marketplace_name',
                title: 'Marketplace',
                sortable: true
            }, {
                field: 'representative_name',
                title: 'Representatives',
                sortable: true
            }, {
                field: 'target',
                title: 'Target',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: averagePriceFormatter
            }, {
                field: 'settlement_agreement_file',
                title: 'Agreement File',
                sortable: true,
                formatter: function (value, row, index) {
                    return '<a href="/getAgreementFile?file='+ value +'" target="_blank">Link</a>';
                }
            }, {
                field: 'money_received',
                title: 'Money Received',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: averagePriceFormatter
            }, {
                field: 'status',
                title: 'Status',
                sortable: true
            }, {
                field: 'created_at',
                title: 'Created At',
                sortable: true,
                formatter: dateTimeFormatter
            }, {
                field: 'updated_at',
                title: 'Last Updated',
                sortable: true,
                formatter: dateTimeFormatter
        }]
    };

    function caseDetailsFormatter(data) {
        $("#caseDetailsId").text('Case #'+ data.id);
        $("#caseDetailsDate").text(data.date);
        $("#caseDetailsLfFees").text('$'+ data.lf_fee);
        $("#caseDetailsAxsFees").text('$'+ data.axs_fee);
        $("#caseDetailsCreatedAt").text(dateTimeFormatter(data.created_at, null));
        $("#caseDetailsUpdatedAt").text(dateTimeFormatter(data.updated_at, null));
        $("#caseDetailsStatus").text(data.status);
        $("#caseDetails").modal("show");
    }

    function clientSellerDetailsFormatter(data) {
        $("#partyDetailTitle").text(data.modalTitle);
        $("#partyDetailName").text(data.name);
        $("#partyDetailEmail").text(data.email);
        $("#partyDetailPhone").text(data.phone);
        $("#partyDetailAddress").text(data.address);
        $("#partyDetails").modal("show");
    }

    // format client/seller column
    function clientSellerColumnFormatter(value, row, index) {
        return '<a href="javascript:void(0)" class="">'+ value.name +'</a>';
    }

    // format client/seller column
    function clientSellerColumnFormatterForSettlement(value, row, index) {
        return '<a href="javascript:void(0)" class="">'+ value +'</a>';
    }

    // data table
    $("#data_table").bootstrapTable('showLoading');

    // load user list as it is out default view
    reconstructTableWithGet('Seller List: ', '/getSellers', tableStructure.sellerList, true, null, true);

    // on click user list sidebar button load user list
    $(".sidebar-btn").on("click", function() {

        // handele left sidebar
        $("#management_sidebar>div>div>a.active").removeClass("active");
        $(this).addClass("active");

        // destroy current table before rebuilding
        $("#data_table").bootstrapTable('destroy');

        switch($(this).attr("data-type")) {

            case "Seller":
                $("#addData").attr("data-target", "#addOrUpdateSeller");
                $("#addOrUpdateSeller").find(".addOrUpdateClass").attr("data-url", "/addSeller");
                $("#addData").attr("data-modal-title", "Add New Seller Account");
                $("#updateData").attr("data-target", "#addOrUpdateSeller");
                $("#updateData").attr("data-modal-title", "Upate Seller Account");
                $("#confirm_delete-btn").attr('data-url', '/deleteSeller');
                reconstructTableWithGet('Seller Lists: ', '/getSellers', tableStructure.sellerList, true, null, true);
                break;

            case "Settlement":
                $("#addData").attr("data-target", "#addOrUpdateSettlement");
                $("#addOrUpdateSettlement").find(".addOrUpdateClass").attr("data-url", "/addSettlement");
                $("#addData").attr("data-modal-title", "Add New Settlement");
                $("#updateData").attr("data-target", "#addOrUpdateSettlement");
                $("#updateData").attr("data-modal-title", "Upate Settlement");
                $("#confirm_delete-btn").attr('data-url', '/deleteSettlement');
                reconstructTableWithGet('Settlement List: ', '/getSettlements', tableStructure.settlementList, true, null, true);
                break;
        }

        return false;
    });

    // handles ajax get requests and load data into table
    function reconstructTableWithGet(tableTitle, url, tableScheme, hideLoadingScreen = true, callback = null, showFooterBool = false) {

        // show ajax loading
        $(".bg_wait").show();

        // destroy the current table
        $("#data_table").bootstrapTable('destroy');

        // change table title
        $("#table_toolbar_title").html(tableTitle); 

        // load user list from database
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {

                // check response
                if(response.response === 'success') {
                    var tempdata = [];

                    // loop through the response data and store
                    $.each(response.data, function(index, value) {
                        tempdata.push(value);
                    });

                    // load data into table
                    $('#data_table').bootstrapTable({
                        columns: tableScheme, 
                        showFooter: showFooterBool,
                        data: tempdata
                    });

                    // hide ajax wait
                    setTimeout(function(){
                        $(".bg_wait").hide();
                    }, 1000);
                } else {

                    // show success message
                    $("#snackbar").html(response.message);

                    // show snackbar
                    showSnackBar();
                }
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: function(e, status) {
                if(typeof callback === 'function') {
                    callback();
                }
            }
        });
    }


    // format datetime
    function dateTimeFormatter(value, row) {
        var dateTime = new Date(value);
        return dateTime.getUTCFullYear() + "/" + ("0" + (dateTime.getUTCMonth()+1)).slice(-2) + "/" + ("0" + dateTime.getUTCDate()).slice(-2) + " " + ("0" + dateTime.getUTCHours()).slice(-2) + ":" + ("0" + dateTime.getUTCMinutes()).slice(-2) + ":" + ("0" + dateTime.getUTCSeconds()).slice(-2);
    }

    function totalPriceFormatter(data) {
        var field = this.field;
        var result = data.map(function (row) {
            return +row[field];
        }).reduce(function (sum, i) {
            return (sum + i);
        }, 0);

        return '$'+ (result.toFixed(2));
    }

    function averagePriceFormatter(data) {
        var field = this.field;
        var result = data.map(function (row) {
            return +row[field];
        }).reduce(function (sum, i) {
            return (sum + i);
        }, 0);
        return result ? '$'+ ((result / data.length).toFixed(2)) : '$0.00';
    }

    function totalCountFormatter(data) {
        var field = this.field;
        return data.map(function (row) {
            return +row[field];
        }).reduce(function (sum, i) {
            return (sum + i);
        }, 0);
    }
});