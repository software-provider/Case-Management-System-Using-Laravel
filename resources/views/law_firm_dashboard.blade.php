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
                                    <a id="seller-list-tab-btn" class="sidebar-btn list-group-item list-group-item-action active" href="" data-type="Seller"><i class="fa fa-address-book" aria-hidden="true"></i> Sellers</a>
                                    <a id="settlement-list-tab-btn" class="sidebar-btn list-group-item list-group-item-action" href="" data-type="Settlement"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Settlements</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9 col-sm-8 col-lg-10">
                    <div class="h-100">
                        <div class="col-12 main_container">
                            <div id="tableToolbar" data-type="Seller" style="display: none;">
                                <strong id="table_toolbar_title">User List: </strong>
                                <button id="addData" class="btn btn-primary" data-toggle="modal" data-target="#addOrUpdateSettlement" data-modal-title="Add New Settlement">
                                    <i class="fa fa-plus-square"></i> Add New
                                </button>
                                <button id="updateData" class="btn btn-info" data-modal-title="Update Settlement Account">
                                    <i class="fa fa-pencil-square"></i> Update
                                </button>
                            </div>
                            <table id="data_table" data-toolbar="#tableToolbar" data-show-search-clear-button="true" data-search-highlight="true" data-sortable="true" data-toolbar-align="left" data-show-columns="true" data-search="true" data-page-size="10" data-single-select="true" data-page-list="[10, 25, 50, 100, all]" data-pagination="true"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Models -->
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

        <!-- Snackbar message -->
        <div id="snackbar"></div>

        <!-- Adding scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
        <script src="/js/law_firm_script.js"></script>
    </body>
</html>