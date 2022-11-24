<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/images/favicon.png" type="image/png">

        <!-- Bootstrap CSS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cabin+Condensed:wght@700&family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
        <link rel="stylesheet" href="/css/style.css">
        <title>Dashboard - Case Management Tool</title>
    </head>
    <body>
        <div class="bg_wait show">
            <div class="spinner-grow text-success"></div>
        </div>
        <div class="container-fullwidth h-100">
            <div class="row no-gutters">
                <nav class="navbar navbar-default navbar-fixed-top">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="320px" height="50px" xml:space="preserve">
                                <defs>
                                    <pattern id="water" width=".25" height="1.1" patternContentUnits="objectBoundingBox">
                                        <path fill="#000000" d="M0.25,1H0c0,0,0-0.659,0-0.916c0.083-0.303,0.158,0.334,0.25,0C0.25,0.327,0.25,1,0.25,1z"/>
                                    </pattern>
                                    <text id="text" transform="translate(1,40)" font-family="'Cabin Condensed'" font-size="40">CASE MANAGEMENT</text>
                                    <mask id="text-mask">
                                        <use x="0" y="0" xlink:href="#text" opacity="1" fill="#f8f8f8"/>
                                    </mask>
                                    <g id="eff">
                                        <use x="0" y="0" xlink:href="#text" fill="#a2a3a5"/>
                                        <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" x="-300" y="25" width="1200" height="40" opacity="0.3">
                                            <animate attributeType="xml" attributeName="x" from="-300" to="0" repeatCount="indefinite" dur="2s"/>
                                        </rect>
                                        <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" y="20" width="1600" height="40" opacity="0.3">
                                            <animate attributeType="xml" attributeName="x" from="-400" to="0" repeatCount="indefinite" dur="3s"/>
                                        </rect>
                                        <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" y="30" width="800" height="40" opacity="0.3">
                                            <animate attributeType="xml" attributeName="x" from="-200" to="0" repeatCount="indefinite" dur="1.4s"/>
                                        </rect>
                                        <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" y="30" width="2000" height="40" opacity="0.3">
                                            <animate attributeType="xml" attributeName="x" from="-500" to="0" repeatCount="indefinite" dur="2.8s"/>
                                        </rect>
                                    </g>
                                </defs>
                                <use xlink:href="#eff" opacity="1"/>
                            </svg>
                        </a>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</button>
                        <div class="dropdown-menu top_drop_down" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="row no-gutters h-100">
                <div id="left_container_data" class="col-xs-12 col-md-3 col-sm-4 col-lg-2 d-none d-sm-block h-100 d-inline-block">
                    <div class="card">
                        <div id="management_sidebar">
                            <div class="card-body">
                                <div class="list-group">
                                    <a class="sidebar-btn list-group-item list-group-item-action active" href="" data-type="User"><i class="fa fa-users" aria-hidden="true"></i> Users</a>
                                    <a id="seller-list-tab-btn" class="sidebar-btn list-group-item list-group-item-action" href="" data-type="Seller"><i class="fa fa-address-book" aria-hidden="true"></i> Sellers</a>
                                    <a class="sidebar-btn list-group-item list-group-item-action" href="" data-type="Case"><i class="fa fa-file-text" aria-hidden="true"></i> Cases</a>
                                    <a id="settlement-list-tab-btn" class="sidebar-btn list-group-item list-group-item-action" href="" data-type="Settlement"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Settlements</a>
                                    <a class="sidebar-btn list-group-item list-group-item-action" href="" data-type="Expense"><i class="fa fa-money" aria-hidden="true"></i> Expenses</a>
                                    <a class="sidebar-btn list-group-item list-group-item-action" href="" data-type="Income"><i class="fa fa-suitcase" aria-hidden="true"></i> Incomes</a>
                                    <a class="sidebar-btn list-group-item list-group-item-action" href="" data-type="LfReceived"><i class="fa fa-get-pocket" aria-hidden="true"></i> LF Received</a>
                                    <a class="sidebar-btn list-group-item list-group-item-action" href="" data-type="LfSent"><i class="fa fa-paper-plane" aria-hidden="true"></i> LF Sent</a>
                                    <a class="sidebar-btn list-group-item list-group-item-action" href="" data-type="ClientAccounting"><i class="fa fa-university" aria-hidden="true"></i> Accounting</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9 col-sm-8 col-lg-10">
                    <div class="h-100">
                        <div class="col-12 main_container">
                            <div id="tableToolbar" data-type="User">
                                <div id="main_toolbar">
                                    <strong id="table_toolbar_title">User List: </strong>
                                    <button id="addData" class="btn btn-primary" data-toggle="modal" data-target="#addOrUpdateUser" data-modal-title="Add New Account">
                                        <i class="fa fa-plus-square"></i> Add New
                                    </button>
                                    <button id="updateData" class="btn btn-info" data-modal-title="Update User Account">
                                        <i class="fa fa-pencil-square"></i> Update
                                    </button>
                                    <button id="deleteData" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <div id="date_range_container" style="display: none;">
                                    <input id="date-range-picker" type="text" class="form-control" name="date" placeholder="Filter by date range" required="required" readonly="readonly">
                                </div>
                            </div>
                            <table id="data_table" data-toolbar="#tableToolbar" data-show-search-clear-button="true" data-search-highlight="true" data-sortable="true" data-toolbar-align="left" data-show-columns="true" data-search="true" data-page-size="10" data-single-select="true" data-page-list="[10, 25, 50, 100, all]" data-pagination="true"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Models -->
        <!-- Add new user modal -->
        <div class="modal fade" id="addOrUpdateUser" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="user-add-update-form">
                            <div class="form-group">
                                <input type="text" class="form-control" id="user-name" placeholder="Enter Name" required="required">
                                <div class="invalid-feedback">Please enter name!</div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="user-email" placeholder="Enter email" required="required">
                                <div class="invalid-feedback">Please enter email address!</div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="user-password" placeholder="Password" required="required">
                                <small id="passwordUpdateHelpText" class="form-text text-muted">Leave blank if you don't want to change.</small>
                                <div class="invalid-feedback">Please enter password!</div>
                            </div>
                            <div class="form-group">
                                <select id="user-account_type" name="user-account_type" class="form-control custom-select" required="required">
                                    <option value="">Choose Account Type</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Law Firm">Law Firm</option>
                                    <option value="Client">Client</option>
                                </select>
                                <div class="invalid-feedback">Please select account type from the list!</div>
                            </div>
                            <div class="form-group">
                                <select id="user-account_status" name="user-account_status" class="form-control custom-select" required="required">
                                    <option value="">Choose Account Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Banned">Banned</option>
                                </select>
                                <div class="invalid-feedback">Please select account status from the list!</div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="user-phone" placeholder="Enter Phone">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="user-address" placeholder="Enter Address" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary addOrUpdateClass" data-url="/addUser">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new seller modal -->
        <div class="modal fade" id="addOrUpdateSeller" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New Seller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" method="POST" id="seller-add-update-form">
                            <div class="form-group">
                                <input class="form-control" id="seller-doe" placeholder="DOE Number" required="required">
                                <div class="invalid-feedback">DOE is required and must be positive number!</div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="seller-name" placeholder="Enter Seller Name" required="required">
                                <div class="invalid-feedback">Seller name is rquired!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="seller-total_amount_frozen" type="text" class="form-control" placeholder="Total Amount Frozen" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Total Amount Frozen is required and must be positive number!</div>
                            </div>
                            <div class="form-group">
                                <input type="number" min="0" class="form-control" id="seller-units_sold" placeholder="Units Sold" min="0">
                                <div class="invalid-feedback">Units sold can be left empty or positive any number!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="seller-product_gmv" type="text" class="form-control" placeholder="Product GMV (Wish)" min="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Product GMV (Wish) can be left empty or positive any number!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="seller-amount_frozen_usd" type="text" class="form-control" placeholder="Amount frozen">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Amount frozen USD can be left empty or positive any number!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="seller-amount_frozen_cny" type="text" class="form-control" placeholder="Amount frozen">
                                <div class="input-group-append">
                                    <span class="input-group-text">CNY</span>
                                </div>
                                <div class="invalid-feedback">Amount frozen can be left empty or positive any number!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select ajax_options" id="seller-marketplace" class="form-control" name="seller-marketplace" data-url="/getMarketplaces" autocomplete="off" required="required" data-show-val="Select Marketplace" data-loaded="no">
                                    <option value="" selected="selected">Select Marketplace</option>
                                </select>
                                <div class="invalid-feedback">You must select marketplace from the list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select ajax_options" id="seller-case" class="form-control" name="seller-case" data-url="/getCaseList" autocomplete="off" required="required" data-show-val="Select Case" data-loaded="no">
                                    <option value="">Select Case</option>
                                </select>
                                <div class="invalid-feedback">You must select case from the list!</div>
                            </div>
                            <div class="form-group">
                                <input type="url" class="form-control" id="seller-product_url" placeholder="Product URL" required="required">
                                <div class="invalid-feedback">Enter product url. E.g: https://google.com</div>
                            </div>
                            <div class="form-group">
                                <input type="url" class="form-control" id="seller-store_url" placeholder="Store URL" required="required">
                                <div class="invalid-feedback">Enter store url. E.g: https://google.com</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new case modal -->
        <div class="modal fade" id="addOrUpdateCase" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="case-add-update-form">
                            <div class="form-group">
                                <select class="custom-select ajax_options" id="case-client" class="form-control" name="case-client" data-url="/getClientList" autocomplete="off" required="required" data-show-val="Select Client" data-loaded="no">
                                    <option value="" selected="selected">Select Client</option>
                                </select>
                                <div class="invalid-feedback">You must select client from the list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select ajax_options" id="case-lf" class="form-control" name="case-lf" data-url="/getLfList" autocomplete="off" required="required" data-show-val="Select Law Firm" data-loaded="no">
                                    <option value="" selected="selected">Select Law Firm</option>
                                </select>
                                <div class="invalid-feedback">You must select law firm from the list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select ajax_options" id="case-allowed_user" class="form-control" name="case-allowed_user" data-url="/getAllowedUserList" autocomplete="off" data-show-val="Select Allowed User" data-loaded="no">
                                    <option value="" selected="selected">Select Allowed User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="custom-select ajax_options" id="case-status" class="form-control" name="case-allowed_user" autocomplete="off" required="required" data-show-val="Select Allowed User" data-loaded="no">
                                    <option value="" selected="selected">Select Case Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                <div class="invalid-feedback">You must select case status from the list!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="case-lf_fee" type="text" class="form-control" placeholder="Law Firm Fee" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">You must enter law firm fee!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="case-axs_fee" type="text" class="form-control" placeholder="AXS Fee" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">You must enter AXS fee!</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new settlement modal -->
        <div class="modal fade" id="addOrUpdateSettlement" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New Settlement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="settlement-add-update-form">
                            <div class="form-group">
                                <select class="custom-select form-control" id="settlement-linked_case" name="linked_case" data-url="/getCaseList" autocomplete="off" data-show-val="Select Linked Case" data-loaded="no" required="required">
                                    <option value="">Select Linked Case</option>
                                </select>
                                <div class="invalid-feedback">You must select a case from the list!</div>
                            </div>
                            <div class="form-group">
                                <div class="dropdown">
                                    <ul id="settlement-sellers" class="form-control multi_select is-invalid"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <li id="select_seller_dropdown">Select Sellers</li>
                                    </ul>
                                    <div class="dropdown-menu" id="seller_list_from_server"></div>
                                </div>
                                <div id="select_seller_dropdown_error" class="invalid-feedback" style="display: block;">You must select at least one seller from the list!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">All Seller Total Frozen</span>
                                </div>
                                <div class="form-control" id="seller-total-frozen-amount">0</div>
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="settlement-offered_amount" name="offered_amount" type="text" class="form-control" placeholder="Offered Amount" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Please enter offered amount!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="settlement-marketplace" name="marketplace" data-url="/getMarketplaces" autocomplete="off" data-show-val="Select Marketplace" data-loaded="no" required="required">
                                    <option value="">Select Marketplace</option>
                                </select>
                                <div class="invalid-feedback">You must select a marketplace from the list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="settlement-representative" name="representatives" data-url="/getRepresentatives" autocomplete="off" data-show-val="Select Representative" data-loaded="no" required="required">
                                    <option value="">Select Representative</option>
                                </select>
                                <div class="invalid-feedback">You must select a representative from the list!</div>
                            </div>
                            <div class="form-group">
                                <select id="settlement-status" name="status" class="form-control custom-select" required="required">
                                    <option value="">Choose Settlement Status</option>
                                    <option value="Agreed">Agreed</option>
                                    <option value="Agreement Signed">Agreement Signed</option>
                                    <option value="Contacted">Contacted</option>
                                    <option value="Dismissed">Dismissed</option>
                                    <option value="Money Received">Money Received</option>
                                    <option value="Negotiation in Progress">Negotiation in Progress</option>
                                </select>
                                <div class="invalid-feedback">You must select settlement status from list!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="settlement-target" type="text" class="form-control" name="target" placeholder="Target" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Please enter target amount!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="settlement-money_received" type="text" name="money_received" class="form-control" placeholder="Money Received" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Please enter money received!</div>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="agreement_file" id="settlement-agreement_file" required="required" data-no-file-label="Choose Agreement file...">
                                <label class="custom-file-label" for="settlement-agreement_file">Choose Agreement file...</label>
                                <div class="invalid-feedback">You must upload pdf agreement file!</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass" data-file-upload="true">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new expense modal -->
        <div class="modal fade" id="addOrUpdateExpense" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="expense-add-update-form">
                            <div class="form-group">
                                <input id="expense-date" type="text" class="form-control" name="date" placeholder="Date" required="required" data-picker="datePicker">
                                <div class="invalid-feedback">Please select a date!</div>
                            </div>
                            <div class="form-group">
                                <input id="expense-expense_name" type="text" class="form-control" name="expense_name" placeholder="Expense Name" required="required">
                                <div class="invalid-feedback">Please enter expense name!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="expense-amount" type="text" class="form-control" name="amount" placeholder="Amount" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Please enter amount!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="expense-linked_case" name="linked_case" data-url="/getCaseList" autocomplete="off" data-show-val="Select Case" data-loaded="no" required="required">
                                    <option value="">Select Case</option>
                                </select>
                                <div class="invalid-feedback">Please select case from list!</div>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_upload" id="expense-file_upload" required="required" data-no-file-label="Choose Upload File...">
                                <label class="custom-file-label" for="settlement-agreement_file">Choose Upload file...</label>
                                <div class="invalid-feedback">Please upload pdf file!</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass" data-file-upload="true">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new income modal -->
        <div class="modal fade" id="addOrUpdateIncome" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New Income</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="income-add-update-form">
                            <div class="form-group">
                                <input id="income-date" type="text" class="form-control" name="date" placeholder="Date" required="required" data-picker="datePicker">
                                <div class="invalid-feedback">Please select a date!</div>
                            </div>
                            <div class="form-group">
                                <textarea rows="5" id="income-description" type="text" class="form-control" name="description" placeholder="Description..." required="required"></textarea>
                                <div class="invalid-feedback">Please enter description!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="income-amount" type="text" class="form-control" name="amount" placeholder="Amount" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Please enter amount!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="income-linked_case" name="linked_case" data-url="/getCaseList" autocomplete="off" data-show-val="Select Case" data-loaded="no" required="required">
                                    <option value="">Select Case</option>
                                </select>
                                <div class="invalid-feedback">Please select case from list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="income-settlement_id" name="settlement_id" data-url="/getSettlementList" autocomplete="off" data-show-val="Select Settlement" data-loaded="no" required="required">
                                    <option value="">Select Settlement</option>
                                </select>
                                <div class="invalid-feedback">Please select settlement from list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="income-seller_id" name="seller_id" data-url="/getSellerList" autocomplete="off" data-show-val="Select Seller" data-loaded="no" required="required">
                                    <option value="">Select Seller</option>
                                </select>
                                <div class="invalid-feedback">Please select seller from list!</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new lf received modal -->
        <div class="modal fade" id="addOrUpdateLfReceived" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New LF Received</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="lfReceived-add-update-form">
                            <div class="form-group">
                                <select class="custom-select form-control" id="lfReceived-linked_case" name="linked_case" data-url="/getCaseList" autocomplete="off" data-show-val="Select Case" data-loaded="no" required="required">
                                    <option value="">Select Case</option>
                                </select>
                                <div class="invalid-feedback">Please select case from list!</div>
                            </div>
                            <div class="form-group">
                                <div>LF sent type:</div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="lfReceived-type_default" name="type" required="required">
                                    <label class="custom-control-label" for="lfReceived-type_default">Default</label>
                                </div>
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" class="custom-control-input" id="lfReceived-type_settlement" name="type" required="required">
                                    <label class="custom-control-label" for="lfReceived-type_settlement">Settlement</label>
                                    <div class="invalid-feedback" style="margin-left: -1.5rem;">Please select settlement type!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea rows="5" id="lfReceived-comment" type="text" class="form-control" name="comment" placeholder="Comment..." required="required"></textarea>
                                <div class="invalid-feedback">Please enter comment!</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass">Add Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add new lf sent modal -->
        <div class="modal fade" id="addOrUpdateLfSent" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title addOrUpdateTitle">Add New LF Sent</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-error" style="display: none;">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"></div>
                        </div>
                        <form class="was-validated" id="lfSent-add-update-form">
                            <div class="form-group">
                                <select class="custom-select form-control" id="lfSent-linked_case" name="linked_case" data-url="/getCaseList" autocomplete="off" data-show-val="Select Case" data-loaded="no" required="required">
                                    <option value="">Select Case</option>
                                </select>
                                <div class="invalid-feedback">Please select case from list!</div>
                            </div>
                            <div class="form-group">
                                <select class="custom-select form-control" id="lfSent-settlement_id" name="settlement_id" data-url="/getSettlementList" autocomplete="off" data-show-val="Select Settlement" data-loaded="no" required="required">
                                    <option value="">Select Settlement</option>
                                </select>
                                <div class="invalid-feedback">Please select settlement ID from list!</div>
                            </div>
                            <div class="form-group">
                                <input id="lfSent-date" type="text" class="form-control" name="date" placeholder="Date" required="required" data-picker="datePicker">
                                <div class="invalid-feedback">Please select a date!</div>
                            </div>
                            <div class="form-group">
                                <textarea rows="5" id="lfSent-description" type="text" class="form-control" name="description" placeholder="Description..." required="required"></textarea>
                                <div class="invalid-feedback">Please enter description!</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input id="lfSent-amount" type="text" class="form-control" name="amount_sent" placeholder="Amount Sent" required="required">
                                <div class="input-group-append">
                                    <span class="input-group-text">USD</span>
                                </div>
                                <div class="invalid-feedback">Please enter amount!</div>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_upload" id="lfSent-file_upload" required="required" data-no-file-label="Choose Upload File...">
                                <label class="custom-file-label" for="settlement-agreement_file">Choose Upload file...</label>
                                <div class="invalid-feedback">Please upload pdf file!</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary addOrUpdateClass" data-file-upload="true">Add Now</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete confirmation Modal -->
        <div class="modal fade" id="delete_confirmation_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to delete selected row?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>This is permanent action and can not be undone.</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                        <button id="confirm_delete-btn" type="submit" class="btn btn-primary" data-url="/deleteUser">YES</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Show case details modal -->
        <div class="modal fade" id="caseDetails" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card-group">
                            <div class="col-12">
                                <p class="card-text text-center card_text_style">
                                    Case Number: <span id="caseDetailsId"></span><br>
                                    Case Status: <span id="caseDetailsStatus"></span><br>
                                    Case Law Firm Fees: <span id="caseDetailsLfFees"></span><br>
                                    Case AXS Fees: <span id="caseDetailsAxsFees"></span><br>
                                    Created At: <span id="caseDetailsCreatedAt"></span><br>
                                    Last Updated At: <span id="caseDetailsUpdatedAt"></span><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer align-items-end">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Show client/seller details modal -->
        <div class="modal fade" id="partyDetails" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="partyDetailTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row margin_top_bottom_10px">
                            <div class="col-md-2 col-xs-12">Name: </div>
                            <div class="col-md-10 col-xs-12" id="partyDetailName"></div>
                        </div>
                        <div class="row margin_top_bottom_10px">
                            <div class="col-md-2 col-xs-12">Email: </div>
                            <div class="col-md-10 col-xs-12" id="partyDetailEmail"></div>
                        </div>
                        <div class="row margin_top_bottom_10px">
                            <div class="col-md-2 col-xs-12">Phone: </div>
                            <div class="col-md-10 col-xs-12" id="partyDetailPhone"></div>
                        </div>
                        <div class="row margin_top_bottom_10px">
                            <div class="col-md-2 col-xs-12">Address: </div>
                            <div class="col-md-10 col-xs-12" id="partyDetailAddress"></div>
                        </div>
                    </div>
                    <div class="modal-footer align-items-end">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Error info Modal -->
        <div class="modal fade" id="info_provider" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="error_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="error_info_dump"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Snackbar message -->
        <div id="snackbar"></div>

        <!-- Adding scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="/js/admin_script.js"></script>
    </body>
</html>