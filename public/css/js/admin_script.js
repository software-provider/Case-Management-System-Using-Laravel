$(window).on('load', function(){
    var tableStructure = {
        userList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle'
            }, {
                field: 'id',
                title: 'ID',
                sortable: true
            }, {
                field: 'name',
                title: 'Name',
                sortable: true
            }, {
                field: 'email',
                title: 'Email',
                sortable: true
            }, {
                field: 'phone',
                title: 'Phone',
                sortable: true
            }, {
                field: 'address',
                title: 'Address',
                sortable: true
            }, {
                field: 'account_type',
                title: 'Account Type',
                sortable: true
            }, {
                field: 'account_status',
                title: 'Account Status',
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
        }],
        sellerList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle',
                footerFormatter: 'Total'
            }, {
                field: 'id',
                title: 'ID',
                sortable: true
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
        caseList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle'
            }, {
                field: 'id',
                title: 'Case Number',
                sortable: true ,
                formatter: function (value, row, index) {
                    return 'Case #'+ value;
                }
            }, {
                field: 'client',
                title: 'Client',
                sortable: true,
                events: {
                    'click a': function (e, value, row, index) {
                        value.modalTitle = 'Client Details';
                        clientSellerDetailsFormatter(value);
                    }
                },
                formatter: clientSellerColumnFormatter,
                clickToSelect: false
            }, {
                field: 'law_firm',
                title: 'Law Firm',
                sortable: true,
                events: {
                    'click a': function (e, value, row, index) {
                        value.modalTitle = 'Law Firm Details';
                        clientSellerDetailsFormatter(value);
                    }
                },
                formatter: clientSellerColumnFormatter,
                clickToSelect: false
            }, {
                field: 'allowed_user',
                title: 'Allowed User',
                sortable: true,
                events: {
                    'click a': function (e, value, row, index) {
                        value.modalTitle = 'Allowed User';
                        clientSellerDetailsFormatter(value);
                    }
                },
                formatter: clientSellerColumnFormatter,
                clickToSelect: false
            }, {
                field: 'status',
                title: 'Case Status',
                sortable: true
            }, {
                field: 'lf_fee',
                title: 'LF Fees',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                }
            }, {
                field: 'axs_fee',
                title: 'AXS Fees',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                }
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
        }],
        expenseList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle',
                footerFormatter: 'Total'
            }, {
                field: 'id',
                title: 'ID',
                sortable: true
            }, {
                field: 'expense_name',
                title: 'Expense Name',
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
                field: 'amount',
                title: 'Amount',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'date',
                title: 'Date',
                sortable: true
            }, {
                field: 'file_upload',
                title: 'Uploaded File',
                sortable: true,
                formatter: function (value, row, index) {
                    return '<a href="/getExpenseFile?file='+ value +'" target="_blank">Link</a>';
                }
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
        }],
        incomeList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle',
                footerFormatter: 'Total'
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
                field: 'amount',
                title: 'Amount',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'date',
                title: 'Date',
                sortable: true
            }, {
                field: 'settlement_id',
                title: 'Settlement ID',
                sortable: true
            }, {
                field: 'seller_id',
                title: 'Seller ID',
                sortable: true
            }, {
                field: 'description',
                title: 'Description'
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
        }],
        lfReceivedList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle',
                footerFormatter: 'Total'
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
                field: 'type',
                title: 'Type',
                sortable: true
            }, {
                field: 'comment',
                title: 'Comment',
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
        }],
        lfSentList: [{
                field: 'state',
                checkbox: true,
                align: 'center',
                valign: 'middle',
                footerFormatter: 'Total'
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
                field: 'settlement_id',
                title: 'Settlement ID',
                sortable: true
            }, {
                field: 'amount_sent',
                title: 'Amount Sent',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: totalPriceFormatter
            }, {
                field: 'file_upload',
                title: 'Uploaded File',
                sortable: true,
                formatter: function (value, row, index) {
                    return '<a href="/getLfSentFile?file='+ value +'" target="_blank">Link</a>';
                }
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
        }],
        clientAccounting: [{
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
                footerFormatter: 'Total'
            }, {
                field: 'date',
                title: 'Date',
                sortable: true
            }, {
                field: 'expense_amount',
                title: 'Expense',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: function (data) {

                    var total = 0;
                    for(i=0; i < data.length; i++) {
                        if("expense_amount" in data[i]) {
                            total += Number(data[i].expense_amount);
                        }
                    }
                    return '$'+ (total.toFixed(2));
                }
            }, {
                field: 'income_amount',
                title: 'Income',
                sortable: true,
                formatter: function (value, row, index) {
                    return value ? '$'+ value : '-';
                },
                footerFormatter: function (data) {

                    var total = 0;
                    for(i=0; i < data.length; i++) {
                        if("income_amount" in data[i]) {
                            total += Number(data[i].income_amount);
                        }
                    }
                    return '$'+ (total.toFixed(2));
                }
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
    reconstructTableWithGet('User Lists: ', '/getUsers', tableStructure.userList);

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
            case "User":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateUser");
                $("#addOrUpdateUser").find(".addOrUpdateClass").attr("data-url", "/addUser");
                $("#addData").attr("data-modal-title", "Add New Account");
                $("#updateData").attr("data-target", "#addOrUpdateUser");
                $("#updateData").attr("data-modal-title", "Upate User Account");
                $("#confirm_delete-btn").attr('data-url', '/deleteUser');

                reconstructTableWithGet('User List: ', '/getUsers', tableStructure.userList, true);
                break;

            case "Seller":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateSeller");
                $("#addOrUpdateSeller").find(".addOrUpdateClass").attr("data-url", "/addSeller");
                $("#addData").attr("data-modal-title", "Add New Seller Account");
                $("#updateData").attr("data-target", "#addOrUpdateSeller");
                $("#updateData").attr("data-modal-title", "Upate Seller Account");
                $("#confirm_delete-btn").attr('data-url', '/deleteSeller');
                reconstructTableWithGet('Seller List: ', '/getSellers', tableStructure.sellerList, true, null, true);
                break;

            case "Case":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateCase");
                $("#addOrUpdateCase").find(".addOrUpdateClass").attr("data-url", "/addClient");
                $("#addData").attr("data-modal-title", "Add New Case");
                $("#updateData").attr("data-target", "#addOrUpdateCase");
                $("#updateData").attr("data-modal-title", "Upate Case");
                $("#confirm_delete-btn").attr('data-url', '/deleteCase');
                reconstructTableWithGet('Case List: ', '/getCases', tableStructure.caseList, true);
                break;

            case "Settlement":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateSettlement");
                $("#addOrUpdateSettlement").find(".addOrUpdateClass").attr("data-url", "/addSettlement");
                $("#addData").attr("data-modal-title", "Add New Settlement");
                $("#updateData").attr("data-target", "#addOrUpdateSettlement");
                $("#updateData").attr("data-modal-title", "Upate Settlement");
                $("#confirm_delete-btn").attr('data-url', '/deleteSettlement');
                reconstructTableWithGet('Settlement List: ', '/getSettlements', tableStructure.settlementList, true, null, true);
                break;

            case "Expense":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateExpense");
                $("#addOrUpdateExpense").find(".addOrUpdateClass").attr("data-url", "/addExpense");
                $("#addData").attr("data-modal-title", "Add New Expense");
                $("#updateData").attr("data-target", "#addOrUpdateExpense");
                $("#updateData").attr("data-modal-title", "Upate Expense");
                $("#confirm_delete-btn").attr('data-url', '/deleteExpense');
                reconstructTableWithGet('Expense List: ', '/getExpenses', tableStructure.expenseList, true, null, true);
                break;

            case "Income":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateIncome");
                $("#addOrUpdateIncome").find(".addOrUpdateClass").attr("data-url", "/addIncome");
                $("#addData").attr("data-modal-title", "Add New Income");
                $("#updateData").attr("data-target", "#addOrUpdateIncome");
                $("#updateData").attr("data-modal-title", "Upate Income");
                $("#confirm_delete-btn").attr('data-url', '/deleteIncome');
                reconstructTableWithGet('Income List: ', '/getIncomes', tableStructure.incomeList, true, null, true);
                break;

            case "LfReceived":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateLfReceived");
                $("#addOrUpdateLf").find(".addOrUpdateClass").attr("data-url", "/addLfReceived");
                $("#addData").attr("data-modal-title", "Add New LF Received");
                $("#updateData").attr("data-target", "#addOrUpdateLfReceived");
                $("#updateData").attr("data-modal-title", "Upate LF");
                $("#confirm_delete-btn").attr('data-url', '/deleteLfReceived');
                reconstructTableWithGet('LF Received List: ', '/getLfReceived', tableStructure.lfReceivedList, true);
                break;

            case "LfSent":
                $("#main_toolbar").show();
                $("#date_range_container").hide();
                $("#addData").attr("data-target", "#addOrUpdateLfSent");
                $("#addOrUpdateLf").find(".addOrUpdateClass").attr("data-url", "/addLfSent");
                $("#addData").attr("data-modal-title", "Add New LF Sent");
                $("#updateData").attr("data-target", "#addOrUpdateLfSent");
                $("#updateData").attr("data-modal-title", "Upate LF");
                $("#confirm_delete-btn").attr('data-url', '/deleteLfSent');
                reconstructTableWithGet('LF Sent List: ', '/getLfSent', tableStructure.lfSentList, true, null, true);
                break;

            case "ClientAccounting":
                $("#date_range_container").show();
                $("#main_toolbar").hide();
                $("#date-range-picker").val("");
                reconstructTableWithGet('Client Accounting: ', '/getClientAccountingAll', tableStructure.clientAccounting, true, null, true);
                break;

        }

        return false;
    });

    // datepicker
    $(function() {
        $('#date-range-picker').daterangepicker({
            opens: 'center',
            autoUpdateInput: false,
            locale: {
                    cancelLabel: 'Clear'
            }
        });

        $('#date-range-picker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            reconstructTableWithGet('Client Accounting: ', '/getClientAccountingRange?start='+ picker.startDate.format('YYYY-MM-DD') +'&end='+ picker.endDate.format('YYYY-MM-DD'), tableStructure.clientAccounting, true, null, true);
        });

        $('#date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            reconstructTableWithGet('Client Accounting: ', '/getClientAccountingAll', tableStructure.clientAccounting, true, null, true);
        });
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



    /*************************************************************************/
    /****************** Code for seller tab Start*******************************/
    /*************************************************************************/

    // on selection of file show filename
    $("#settlement-agreement_file, #expense-file_upload, #lfSent-file_upload").on("change", function() {

        if($(this).val().split('.').pop() === 'pdf') {
            $(".custom-file-label").text($(this).val());
        } else {
            $(this).val("");
            $(".custom-file-label").text($(this).attr("data-no-file-label"));
        }
    });

    // get marketplaces on click
    $("#seller-marketplace, #seller-case, #case-client, #case-lf, #case-allowed_user, #settlement-linked_case, #settlement-marketplace, #settlement-representative, #expense-linked_case, #income-linked_case, #income-settlement_id, #income-seller_id, #lfReceived-linked_case, #lfSent-linked_case, #lfSent-settlement_id").on("click", function() {
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



    /*************************************************************************/
    /****************** Code for case tab Start*******************************/
    /*************************************************************************/

    // show date picker when someone click
    $('input[data-picker=datePicker]').daterangepicker({
            "singleDatePicker": true,
            "startDate": moment().format('YYYY-MM-DD'),
            locale: {
                format: 'YYYY-MM-DD'
            }
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


    /***********************************/
    // handle table top buttons start
    /***********************************/

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


    /***********************************/
    // handle table top buttons end
    /***********************************/

    function populateData(dataRow, dataType) {

        // clear old data first
        $('form').each(function() { this.reset() });

        switch(dataType) {
            case 'User':
                $("#user-name").val(dataRow.name);
                $("#user-email").val(dataRow.email);
                $("#user-account_type").val(dataRow.account_type);
                $("#user-account_status").val(dataRow.account_status);
                $("#user-password").val("");
                $("#user-phone").val(dataRow.phone);
                $("#user-address").val(dataRow.address);
                break;

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

            case 'Client':
                $("#client-name").val(dataRow.name);
                $("#client-email").val(dataRow.email);
                $("#client-phone").val(dataRow.phone);
                $("#client-address").val(dataRow.address);
                break;

            case 'Case':
                $("#case-date").val(dataRow.date);
                $("#case-client").val(dataRow.client.name);
                $("#case-client").attr("data-id", dataRow.client.id);
                $("#case-seller").val(dataRow.seller.name);
                $("#case-seller").attr("data-id", dataRow.seller.id);
                $("#case-status").val(dataRow.status);
                break;

            case 'Settlement':
                $("#settlement-offered_amount").val(dataRow.offered_amount);
                $("#settlement-target").val(dataRow.target);
                $("#settlement-money_received").val(dataRow.money_received);
                $("#settlement-status").val(dataRow.status);
                break;

            case 'Expense':
                $("#expense-date").val(dataRow.date);
                $("#expense-expense_name").val(dataRow.expense_name);
                $("#expense-amount").val(dataRow.amount);
                break;

            case 'Income':
                $("#income-date").val(dataRow.date);
                $("#income-description").val(dataRow.description);
                $("#income-amount").val(dataRow.amount);
                break;

            case 'LfReceived':
                $("#lfReceived-comment").val(dataRow.comment);
                if(dataRow.type === "Default") {
                    $("#lfReceived-type_default").prop("checked", true);
                } else {
                    $("#lfReceived-type_settlement").prop("checked", true);
                }
                break;

            case 'LfSent':
                $("#lfSent-date").val(dataRow.date);
                $("#lfSent-description").val(dataRow.description);
                $("#lfSent-amount").val(dataRow.amount_sent);
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

    function totalNameFormatter(data) {
        return data.length;
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


    // delete user on request
    $("#deleteData").on("click", function() {

        // get selected row
        var item = $('#data_table').bootstrapTable('getSelections');

        // check if user selected any data row
        if(item.length < 1) {

            // set error info model
            $("#error_title").html('Error occurred!');
            $("#error_info_dump").html('Please choose one item from the table first!');
            $('#info_provider').modal('show');
        } else {

            // assign target id
            $("#confirm_delete-btn").attr('data-id', item[0].id);

            // show update model
            $('#delete_confirmation_modal').modal('show');
        }
    });

    // delete user
    $("#confirm_delete-btn").on("click", function() {

        // hide model now
        $("#delete_confirmation_modal").modal('hide');

        // show ajax loading
        $(".bg_wait").show();

        // post date to save in database
        $.ajax({
            type: "POST",
            url: $(this).attr("data-url"),
            success: function (response) {

                if(response.response == 'success') {

                    // destroy current table before rebuilding
                    $("#data_table").bootstrapTable('destroy');

                    // get data type
                    var data_type = $('#tableToolbar').attr('data-type');
                    var tableStructureKey = data_type.toLowerCase() + 'List';

                    // trigger reload
                    $("#management_sidebar > div > div > a.sidebar-btn.list-group-item.list-group-item-action.active").trigger("click");

                    // hide ajax loading
                    setTimeout(function() {
                        $(".bg_wait").hide();

                        // show success message
                        $("#snackbar").html(response.message);

                        // show snackbar
                        showSnackBar();
                    }, 1000);

                } else {

                        // show success message
                        $("#snackbar").html(response.message);

                        // show snackbar
                        showSnackBar();

                        // hide ajax wait
                        $(".bg_wait").hide();
                }
            },
            data: {
                id: $(this).attr('data-id')
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // validate user form
    function validateUserForm(validatePassword, type) {

        switch(type) {
            case "User":
                if (document.getElementById('user-add-update-form').checkValidity() === false) {
                    $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                    $(".form-error").show();
                    return false;
                } else {
                    $("#user-error").hide();
                    return {
                        name: $("#user-name").val(),
                        email: $("#user-email").val(),
                        password: $("#user-password").val(),
                        account_type: $("#user-account_type").val(),
                        account_status: $("#user-account_status").val(),
                        phone: $("#user-phone").val(),
                        address: $("#user-address").val()
                    };
                }
                break;

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

            case "Client":

                    if($("#client-name").val() == "" || $("#client-email").val() == "" || $("#client-phone").val() == "" || $("#client-address").val() == "") {
                        $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                        $(".form-error").show();
                        return false;
                    } else {
                        $(".form-error").hide();
                        return {
                            name: $("#client-name").val(),
                            email: $("#client-email").val(),
                            phone: $("#client-phone").val(),
                            address: $("#client-address").val()
                        };
                    }
                break;

            case "Case":

                if(document.getElementById('case-add-update-form').checkValidity() === false && ($('#case-client').val() == '' || $('#case-lf').val() == '' || $('#case-allowed_user').val() == '')) {
                    $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                    $(".form-error").show();
                    return false;
                } else {
                    $(".form-error").hide();
                    return {
                        client: $("#case-client").val(),
                        law_firm: $("#case-lf").val(),
                        allowed_user: $("#case-allowed_user").val(),
                        status: $("#case-status").val(),
                        lf_fee: $("#case-lf_fee").val(),
                        axs_fee: $("#case-axs_fee").val()
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

            case "Expense":

                    if(document.getElementById('expense-add-update-form').checkValidity() === false) {
                        $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                        $(".form-error").show();
                        return false;
                    } else {
                        $(".form-error").hide();
                        var formData = new FormData(document.getElementById("expense-add-update-form"));
                        formData.append('id', $('#updateData').attr('data-id'));
                        return formData;
                    }
                break;

            case "Income":

                    if(document.getElementById('income-add-update-form').checkValidity() === false) {
                        $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                        $(".form-error").show();
                        return false;
                    } else {
                        $(".form-error").hide();
                        return {
                            date: $("#income-date").val(),
                            description: $("#income-description").val(),
                            amount: $("#income-amount").val(),
                            linked_case: $("#income-linked_case").val(),
                            settlement_id: $("#income-settlement_id").val(),
                            seller_id: $("#income-seller_id").val()
                        };
                    }
                break;

            case "LfReceived":

                    if(document.getElementById('lfReceived-add-update-form').checkValidity() === false) {
                        $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                        $(".form-error").show();
                        return false;
                    } else {
                        $(".form-error").hide();
                        return {
                            linked_case: $("#lfReceived-linked_case").val(),
                            type: $("#lfReceived-type_default").is(":checked") ? "Default":"Settlement",
                            comment: $("#lfReceived-comment").val()
                        };
                    }
                break;

            case "LfSent":

                    if(document.getElementById('lfSent-add-update-form').checkValidity() === false) {
                        $(".form-error>div").html('<strong>Error!</strong> Please fill in all the required fields!');
                        $(".form-error").show();
                        return false;
                    } else {
                        $(".form-error").hide();
                        var formData = new FormData(document.getElementById("lfSent-add-update-form"));
                        formData.append('id', $('#updateData').attr('data-id'));
                        return formData;
                    }
                break;
        }
    }
});