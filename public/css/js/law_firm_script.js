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
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle',
                footerFormatter: 'Average'
            }, {
                field: 'id',
                title: 'ID',
                sortable: true
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

    // data table
    $("#data_table").bootstrapTable('showLoading');

    // load seller list as it is out default view
    reconstructTableWithGet('Seller List: ', '/getSellers', tableStructure.sellerList, true, null, true);

    // on click user list sidebar button load user list
    $(".sidebar-btn").on("click", function() {

        $("#tableToolbar").attr("data-type", $(this).attr("data-type"));

        // make all select field load data again
        $("#seller-marketplace, #seller-case, #case-client, #case-lf, #case-allowed_user, #settlement-linked_case, #settlement-marketplace, #settlement-representative, #expense-linked_case, #income-linked_case, #income-settlement_id, #income-seller_id, #lfReceived-linked_case, #lfSent-linked_case, #lfSent-settlement_id").each(function(i, obj) {
            $(obj).attr("data-loaded", "no");
            $(obj).prop("disabled", false);
            $(obj).html('<option value="">'+ $(obj).attr('data-show-val') +'</option>');
            $(obj).val("");
        });

        // clear file upload fields
        $('.custom-file-input').each(function(i, obj) {
            $(obj).next().text($(obj).attr("data-no-file-label"));
        });

        // handele left sidebar
        $("#management_sidebar>div>div>a.active").removeClass("active");
        $(this).addClass("active");

        // destroy current table before rebuilding
        $("#data_table").bootstrapTable('destroy');

        switch($(this).attr("data-type")) {

            case "Seller":
                $("#tableToolbar").hide();
                $("#addOrUpdateSeller").find(".addOrUpdateClass").attr("data-url", "/addSeller");
                reconstructTableWithGet('Seller List: ', '/getSellers', tableStructure.sellerList, true, null, true);
                break;

            case "Settlement":
                $("#tableToolbar").show();
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

    // on click add or update button post data to server
    $(".addOrUpdateClass").on("click", function() {

        // get validated form data
        var formData = {},
            data_type = $("#tableToolbar").attr("data-type");

        // check if we have user id availabe to add
        if (typeof $("#updateData").attr("data-id") !== typeof undefined && $("#updateData").attr("data-id") !== false) {

            // we don't need to validae password when updating
            formData = validateUserForm(false, data_type);

            // add the id to form data
            formData.id = $("#updateData").attr("data-id");
        } else {
            formData = validateUserForm(true, data_type);
        }

        if(formData) {

            // get data type
            var tableStructureKey = data_type.toLowerCase() + 'List';

            if($(this).attr("data-file-upload") === "true") {

                // send data to server
                postDataToServer($(this).attr("data-url"), "#addOrUpdate"+ data_type, formData, true);
            } else {

                // send data to server
                postDataToServer($(this).attr("data-url"), "#addOrUpdate"+ data_type, formData);
            }
        }
        return false;
    });

    // on selection of file show filename
    $("#settlement-agreement_file").on("change", function() {

        if($(this).val().split('.').pop() === 'pdf') {
            $(".custom-file-label").text($(this).val());
        } else {
            $(this).val("");
            $(".custom-file-label").text($(this).attr("data-no-file-label"));
        }
    });

    // get marketplaces on click
    $("#seller-marketplace, #seller-case, #settlement-linked_case, #settlement-marketplace, #settlement-representative").on("click", function() {
        var url = $(this).attr("data-url"),
            elem = $(this);

        if($(elem).attr('data-loaded') == 'no') {
            $(elem).html('<option value="">Loading...</option>');
            $(elem).prop('disabled', true);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    if(response.response == 'success') {
                        $(elem).html('');
                        $.each(response.data, function() {
                            $(elem).append('<option value="'+ this.id +'">'+ this.name +'</option>');
                        });
                        $(elem).attr('data-loaded', 'yes');
                    } else {

                    }
                },
                complete: function(e, status) {
                    if($(elem).children('option').length < 1) {
                        $(elem).append('<option value="">Nothing Found</option>');
                        $(elem).addClass('is-invalid');
                        $(elem).prop('disabled', true);
                    } else {
                        $(elem).prepend('<option value="">'+ $(elem).attr('data-show-val') +'</option>');
                        $(elem).val('');
                        $(elem).removeClass('is-invalid');
                        $(elem).prop('disabled', false);
                    }
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    });

    $("#settlement-sellers").on("click", "li > i", function() {
        $($(this).attr("data-deselect-target")).removeClass("disabled");
        $(this).parent().remove();
        $("#seller_list_from_server").dropdown("toggle");
        updateTotalFrozen();
    });

    $("#seller_list_from_server").on("click", "a",function() {
        $(this).addClass("disabled");
        $('#settlement-sellers').append('<li data-id="'+ $(this).attr("data-id") +'" data-total-frozen="'+ $(this).attr("data-total-frozen") +'">'+ $(this).text() +' <i class="fa fa-times-circle" aria-hidden="true" data-deselect-target="#'+ $(this).attr("id") +'"></i></li>');
        updateTotalFrozen();
    });

    // simply calculate the total frozen
    function updateTotalFrozen() {
        var total_frozen = 0, iteration = 0;
        $("#settlement-sellers > li").each(function(index, element) {
            if($(element).attr("id") === "select_seller_dropdown") return;
            iteration++;
            total_frozen += Number($(element).attr("data-total-frozen"));
        });
        if(iteration > 0) {
            $("#select_seller_dropdown").hide();
            $("#select_seller_dropdown_error").hide();
            $("#settlement-sellers").removeClass("is-invalid");
        } else {
            $("#select_seller_dropdown").show();
            $("#select_seller_dropdown_error").show();
            $("#settlement-sellers").addClass("is-invalid");
        }
        $("#seller-total-frozen-amount").text(total_frozen);
    }

    $('#addOrUpdateSettlement').on('show.bs.modal', function (e) {
        $('#seller_list_from_server').html('');
        $('#settlement-sellers').html('<li id="select_seller_dropdown">Select Sellers</li>');
        $('#seller-total-frozen-amount').text('0');
        $.ajax({
            type: "GET",
            url: "/getSellerList",
            success: function(response) {
                if(response.response == 'success') {
                    $.each(response.data, function(key, value) {
                        $('#seller_list_from_server').append('<a id="data-seller-'+ value.id +'" data-id="'+ value.id +'" data-total-frozen="'+ value.total_amount_frozen +'" class="dropdown-item" href="#">'+ value.name +'</a>');
                    });
                    if(response.data.length < 1) {
                        $('#seller_list_from_server').append('<a class="dropdown-item disabled" href="#">No seller found!</a>');
                    }
                }
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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

    // handles ajax get requests
    function postDataToServer(url, modalToHide, formData, hasFile) {

        // show ajax loading
        $(".bg_wait").show();

        if(hasFile) {

            // post date to save in database
            $.ajax({
                type: "POST",
                url: url,
                success: function (response) {

                    if(response.response == 'success') {

                        // hide model now
                        $(modalToHide).modal('hide');

                        // trigger click to reload all the data
                        $("#management_sidebar > div > div > a.sidebar-btn.list-group-item.list-group-item-action.active").trigger("click");

                        // hide ajax loading
                        setTimeout(function() {

                            // show success message
                            $("#snackbar").html(response.message);

                            // show snackbar
                            showSnackBar();
                        }, 1500);

                    } else {

                        // add error into error container
                        $(".form-error>div").html('<strong>Error!</strong> '+ response.message);
                        $(".form-error").show();

                        // hide ajax loading
                        $(".bg_wait").hide();
                    }
                },
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        } else {

            // post date to save in database
            $.ajax({
                type: "POST",
                url: url,
                success: function (response) {

                    if(response.response == 'success') {

                        // hide model now
                        $(modalToHide).modal('hide');

                        // trigger click to reload all the data
                        $("#management_sidebar > div > div > a.sidebar-btn.list-group-item.list-group-item-action.active").trigger("click");

                        // hide ajax loading
                        setTimeout(function() {

                            // show success message
                            $("#snackbar").html(response.message);

                            // show snackbar
                            showSnackBar();
                        }, 1500);

                    } else {

                        // add error into error container
                        $(".form-error>div").html('<strong>Error!</strong> '+ response.message);
                        $(".form-error").show();

                        // hide ajax loading
                        $(".bg_wait").hide();
                    }
                },
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    }

    function addButtonActions() {

        // we will add new data so remove all form input data
        $('form').find('input,textarea,select').val('');

        // update server url
        $(".addOrUpdateClass").attr("data-url", "/add"+ $("#tableToolbar").attr("data-type"));

        // hide password update info if there is one
        $("#passwordUpdateHelpText").hide();

        // set model title to add
        $(".addOrUpdateTitle").text($("#addData").attr("data-modal-title"));

        // update button
        $(".addOrUpdateClass").text('Add Now');

        // hide old error message
        $(".form-error").hide();
    }

    // add button
    $("#addData").on("click", function() {

        // do all the add button actions
        addButtonActions();
    });

    // update button
    $("#updateData").on("click", function() {

        // remove all form input data before we populate with new
        $(document).closest("form").find("input[*], textarea, select").val("");

        // get selected row
        var item = $('#data_table').bootstrapTable('getSelections');

        // check if user selected any data row
        if(item.length < 1) {

            // set error info model
            $("#error_title").html('Error occurred!');
            $("#error_info_dump").html('Please choose one item from table in order to update!');
            $('#info_provider').modal('show');
        } else {

            // update server url
            $(".addOrUpdateClass").attr("data-url", "/update"+ $("#tableToolbar").attr("data-type"));

            // set data id
            $(this).attr("data-id", item[0].id);

            // set model title to update
            $(".addOrUpdateTitle").text($("#updateData").attr("data-modal-title"));

            // show password update helper text and make it not required
            $("#passwordUpdateHelpText").show();
            $("#user-password").prop("required", false);

            $(".addOrUpdateClass").text('Update Now');

            // set current data into form
            populateData(item[0], $("#tableToolbar").attr("data-type"));

            // hide old error message
            $(".form-error").hide();

            // show update model
            $('#addOrUpdate'+ $('#tableToolbar').attr("data-type")).modal('show');
        }
    });

    function populateData(dataRow, dataType) {

        // clear old data first
        $('form').each(function() { this.reset() });

        switch(dataType) {

            case 'Seller':
                $("#seller-name").val(dataRow.name);
                $("#seller-doe").val(dataRow.doe);
                $("#seller-total_amount_frozen").val(dataRow.total_amount_frozen);
                $("#seller-units_sold").val(dataRow.units_sold);
                $("#seller-product_gmv").val(dataRow.product_gmv);
                $("#seller-amount_frozen_usd").val(dataRow.amount_frozen_usd);
                $("#seller-amount_frozen_cny").val(dataRow.amount_frozen_cny);
                $("#seller-marketplace ").val(dataRow.marketplace);
                $("#seller-case").val(dataRow.linked_case);
                $("#seller-product_url").val(dataRow.product_url);
                $("#seller-store_url").val(dataRow.store_url);
                break;

            case 'Settlement':
                $("#settlement-offered_amount").val(dataRow.offered_amount);
                $("#settlement-target").val(dataRow.target);
                $("#settlement-money_received").val(dataRow.money_received);
                $("#settlement-status").val(dataRow.status);
                break;
        }
    }

    // format datetime
    function dateTimeFormatter(value, row) {
        var dateTime = new Date(value);
        return dateTime.getUTCFullYear() + "/" + ("0" + (dateTime.getUTCMonth()+1)).slice(-2) + "/" + ("0" + dateTime.getUTCDate()).slice(-2) + " " + ("0" + dateTime.getUTCHours()).slice(-2) + ":" + ("0" + dateTime.getUTCMinutes()).slice(-2) + ":" + ("0" + dateTime.getUTCSeconds()).slice(-2);
    }

    // simply shows snackbar
    function showSnackBar(hideAfterSec = 4.8) {
        // show snackbar message
        $("#snackbar").addClass("show");

        // remove snackbar message after x seconds
        setTimeout(function(){
            $("#snackbar").removeClass("show");
        }, hideAfterSec * 1000);
    }


    function totalTextFormatter(data) {
        return 'Total';
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

    // validate user form
    function validateUserForm(validatePassword, type) {

        switch(type) {

            case "Seller":
                if (document.getElementById('seller-add-update-form').checkValidity() === false) {
                    $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                    $(".form-error").show();
                    return false;
                } else if($('#seller-case').val() == '') {
                    $(".form-error>div").html('<strong>Error!</strong> No case found! Ask administrator to add one.');
                    $(".form-error").show();
                    return false;
                } else {
                    $(".form-error").hide();
                    return {
                        doe: $("#seller-doe").val(),
                        name: $("#seller-name").val(),
                        total_amount_frozen: $("#seller-total_amount_frozen").val(),
                        units_sold: $("#seller-units_sold").val(),
                        product_gmv: $("#seller-product_gmv").val(),
                        amount_frozen_usd: $("#seller-amount_frozen_usd").val(),
                        amount_frozen_cny: $("#seller-amount_frozen_cny").val(),
                        marketplace: $("#seller-marketplace").val(),
                        linked_case: $("#seller-case").val(),
                        product_url: $("#seller-product_url").val(),
                        store_url: $("#seller-store_url").val()
                    };
                }
                break;

            case "Settlement":

                    if(document.getElementById('settlement-add-update-form').checkValidity() === false || $("#settlement-sellers li").length < 2) {
                        $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                        $(".form-error").show();
                        return false;
                    } else {
                        $(".form-error").hide();
                        var formData = new FormData(document.getElementById("settlement-add-update-form")),
                            sellers = [];

                        $("#settlement-sellers > li").each(function(index, element) {
                            if($(element).attr("id") === "select_seller_dropdown") return;
                            sellers.push($(element).attr("data-id"));
                        });

                        formData.append('sellers', sellers);
                        formData.append('id', $('#updateData').attr('data-id'));

                        return formData;
                    }
                break;
        }
    }
});