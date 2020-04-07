<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dating Strings - DashBoard for Admin</title>
    <link rel = "icon" href = "../../dist-assets/images/Logo-Element.png" type = "image/x-icon"> 
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="../../dist-assets/css/themes/lite-purple.min.css" rel="stylesheet" />
    <link href="../../dist-assets/css/plugins/perfect-scrollbar.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>

<body class="text-left">
        
        <!-- Pre Loader Strat  -->
        <div class='loadscreen' id="preloader">

            <div class="loader spinner-bubble spinner-bubble-primary">


            </div>
        </div>
        <!-- Pre Loader end  -->


        <!-- ============ Compact Layout start ============= -->     
        <div class="app-admin-wrap layout-horizontal-bar clearfix">
            <div class="main-header">
            <div class="logo">
                <img src="../../dist-assets/images/Logo.png" alt="Dating Strings Logo">
            </div>

            <div class="menu-toggle">
                <div></div>
                        <div></div>
                <div></div>
            </div>

            <div class="d-flex align-items-center">
                <!-- Mega menu -->
                <div class="dropdown mega-menu d-none d-md-block">
                    <a href="#" class="btn text-muted dropdown-toggle mr-3" id="dropdownMegaMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mega Menu</a>
                    <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuButton">
                        <div class="row m-0">
                            <div class="col-md-4 p-4 bg-img">
                                <h2 class="title">4-Chaki<br> Sidebar</h2>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores natus laboriosam fugit, consequatur.
                                </p>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem odio amet eos dolore suscipit placeat.</p>
                                <button class="btn btn-lg btn-rounded btn-outline-warning">Learn More</button>
                            </div>
                            <div class="col-md-4 p-4">
                                <p class="text-primary text--cap border-bottom-primary d-inline-block">Features</p>
                                <div class="menu-icon-grid w-auto p-0">
                                    <a href="#"><i class="i-Shop-4"></i> Home</a>
                                    <a href="#"><i class="i-Library"></i> UI Kits</a>
                                    <a href="#"><i class="i-Drop"></i> Apps</a>
                                    <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                                    <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                                    <a href="#"><i class="i-Ambulance"></i> Support</a>
                                </div>
                            </div>
                                 <div class="col-md-4 p-4">
                                <p class="text-primary text--cap border-bottom-primary d-inline-block">Components</p>
                                <ul class="links">
                                    <li><a href="accordion.html">Accordion</a></li>
                                    <li><a href="alerts.html">Alerts</a></li>
                                    <li><a href="buttons.html">Buttons</a></li>
                                    <li><a href="badges.html">Badges</a></li>
                                    <li><a href="carousel.html">Carousels</a></li>
                                    <li><a href="lists.html">Lists</a></li>
                                    <li><a href="popover.html">Popover</a></li>
                                    <li><a href="tables.html">Tables</a></li>
                                    <li><a href="datatables.html">Datatables</a></li>
                                    <li><a href="modals.html">Modals</a></li>
                                    <li><a href="nouislider.html">Sliders</a></li>
                                    <li><a href="tabs.html">Tabs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Mega menu -->
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="search-icon text-muted i-Magnifi-Glass1"></i>
                </div>
            </div>

            <div style="margin: auto"></div>

            <div class="header-part-right">
                <!-- Full screen toggle -->
                <!-- <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i> -->
                <!-- Grid menu Dropdown -->
                <!-- <div class="dropdown widget_dropdown">
                    <i class="i-Safe-Box text-muted header-icon" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="#"><i class="i-Shop-4"></i> Home</a>
                            <a href="#"><i class="i-Library"></i> UI Kits</a>
                            <a href="#"><i class="i-Drop"></i> Apps</a>
                            <a href="#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="#"><i class="i-Checked-User"></i> Sessions</a>
                            <a href="#"><i class="i-Ambulance"></i> Support</a>
                        </div>
                    </div>
                </div> -->

                <a href="/logout">Logout</a>
                <!-- Notificaiton -->
                {{-- <div class="dropdown">
                    <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-primary">3</span>
                        <i class="i-Bell text-muted header-icon"></i>
                    </div>
                    <!-- Notification dropdown -->
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New message</span>
                                    <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 sec ago</span>
                                </p>
                                <p class="text-small text-muted m-0">James: Hey! are you busy?</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Receipt-3 text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New order received</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">2 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">1 Headphone, 3 iPhone x</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Empty-Box text-danger mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Product out of stock</span>
                                    <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Data-Power text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Server Up!</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">14 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Server rebooted successfully</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Notificaiton End -->


                 <!-- User avatar dropdown -->
                 <div class="dropdown">
                    <div  class="user col align-self-end">
                        <img src="listing.html/assets/images/faces/1.jpg" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> Timothy Carlson
                            </div>
                            <a class="dropdown-item">Account settings</a>
                            <a class="dropdown-item">Billing history</a>
                            <a class="dropdown-item" href="/logout">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- header top menu end -->

            <!-- ============ end of header menu ============= -->
        <div class="horizontal-bar-wrap">
            <div class="header-topnav">
                <div class="container-fluid">
                    <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                        <ul class="menu float-left">
                            <li class="">
                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

                                        Dashboard
                                    </label>
                                        <a href="/admindashboard">
                                            <i class="nav-icon mr-2 i-Bar-Chart"></i>
                                             Dashboard
                                        </a>

                                        <input type="checkbox" id="drop-2">
                                        <ul>

<!--                                             <li class="nav-item ">
                        <a class="" href="listing.html/dashboard/dashboard1">
                            <i class="nav-icon mr-2 i-Clock-3"></i>
                            <span class="item-name">Version 1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://gull-html-laravel.ui-lib.com/dashboard/dashboard2" class="">
                            <i class="nav-icon mr-2 i-Clock-4"></i>
                            <span class="item-name">Version 2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="http://gull-html-laravel.ui-lib.com/dashboard/dashboard3" >
                            <i class="nav-icon mr-2 i-Over-Time"></i>
                            <span class="item-name">Version 3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="http://gull-html-laravel.ui-lib.com/dashboard/dashboard4">
                            <i class="nav-icon mr-2 i-Clock"></i>
                            <span class="item-name">Version 4</span>
                        </a>
                    </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

UI kits
                                        </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Suitcase"></i> Add Profile to display
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                    <li class="nav-item">
                        <a class="" href="/addprofile">
                            <i class="nav-icon mr-2 i-Bell1"></i>
                            <span class="item-name">Add Profile</span>
                        </a>
                    </li>

                                                               <li class="nav-item">
                    <a class="" href="/showprofile">
                            <i class="nav-icon mr-2 i-Bell1"></i>
                            <span class="item-name">Show all Profile</span>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Medal-2"></i>
                            <span class="item-name">Ongoing</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Completed</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Cancelled</span>
                        </a>
                    </li> --}}
<!--                           <li class="nav-item">
                        <a class="" href="listing.html/uikits/accordion">
                            <i class="nav-icon mr-2 i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Accordion</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/lists">
                            <i class="nav-icon mr-2 i-Belt-3"></i>
                            <span class="item-name">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/pagination">
                            <i class="nav-icon mr-2 i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/popover">
                            <i class="nav-icon mr-2 i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/progressbar">
                            <i class="nav-icon mr-2 i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tabs">
                            <i class="nav-icon mr-2 i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tooltip">
                            <i class="nav-icon mr-2 i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/modals">
                            <i class="nav-icon mr-2 i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li> -->


                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- end ui kits -->

                            <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

                Extra UI kits
            </label>
                                        <a href="#">
                                            <i class="nav-icon i-Library mr-2"></i> Configuration
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>
                                               <li class="nav-item">
                        <a class="" href="/addconfiguration">
                            <i class="nav-icon mr-2 i-Arrow-Down-in-Circle"></i>
                            <span class="item-name">Add Configuration</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="/showconfiguration">
                            <i class="nav-icon mr-2 i-Line-Chart-2"></i>
                            <span class="item-name">Show configuation</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-ID-Card"></i>
                            <span class="item-name">Cancelled Order</span>
                        </a>
                    </li>
   <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Video-Photographer"></i>
                            <span class="item-name">Add new Order</span>
                        </a>
                    </li>
  <li class="nav-item"> --}}
                        <!-- <a class="" href="listing.html/uikits/tables">
                            <i class="nav-icon mr-2 i-File-Horizontal-Text"></i>
                            <span class="item-name">Tables</span>
                        </a>
                    </li>
  <li class="nav-item">
                        <a class="" href="listing.html/uikits/NoUislider">
                            <i class="nav-icon mr-2 i-Width-Window"></i>
                            <span class="item-name">Sliders</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="" href="listing.html/extrakits/imageCroper">
                            <i class="nav-icon mr-2 i-Crop-2"></i>
                            <span class="item-name">Image Cropper</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/extrakits/loader">
                            <i class="nav-icon mr-2 i-Loading-3"></i>
                            <span class="item-name">Loaders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/extrakits/laddaButton">
                            <i class="nav-icon mr-2 i-Loading-2"></i>
                            <span class="item-name">Ladda Buttons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/extrakits/toastr">
                            <i class="nav-icon mr-2 i-Bell"></i>
                            <span class="item-name">Toastr</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/extrakits/sweetAlert">
                            <i class="nav-icon mr-2 i-Approved-Window"></i>
                            <span class="item-name">Sweet Alerts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/extrakits/tour">
                            <i class="nav-icon mr-2 i-Plane"></i>
                            <span class="item-name">User Tour</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/extrakits/upload">
                            <i class="nav-icon mr-2 i-Data-Upload"></i>
                            <span class="item-name">Upload</span>
                        </a> -->
                    </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- end extra uikits -->

                            <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

Apps
            </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Computer-Secure"></i> Slotting
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                                           <li class="nav-item">
                        <a class="" href="/addslotting">
                            <i class="nav-icon mr-2 i-Add-File"></i>
                            <span class="item-name">Add Slotting</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="/showallslots">
                            <i class="nav-icon mr-2 i-Email"></i>
                            <span class="item-name">Show All Slotting</span>
                        </a>
                    {{-- </li>
                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Speach-Bubble-3"></i>
                            <span class="item-name">Completed</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Calendar-4"></i>
                            <span class="item-name">Cancelled Detaling</span>
                        </a>
                    </li> --}}
                           <!-- <li class="nav-item">
                        <a class="" href="listing.html/apps/task-manager">
                            <i class="nav-icon mr-2 i-Receipt"></i>
                            <span class="item-name">Task manager</span>
                        </a>
                    </li>
                       <li class="nav-item">
                        <a class="" href="listing.html/apps/task-manager-list">
                            <i class="nav-icon mr-2 i-Receipt-4"></i>
                            <span class="item-name">Task  list</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="listing.html/apps/toDo">
                            <i class="nav-icon mr-2 i-Receipt-4"></i>
                            <span class="item-name">Minimal ToDo</span>
                        </a>
                    </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- end apps -->

                            <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

Forms
            </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-File-Clipboard-File--Text"></i> SuperLike List
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                                             <li class="nav-item">
                        <a class="" href="/superlikepckglist">
                            <i class="nav-icon mr-2 i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Show All Superlike Package</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="/addsuperlikepackage">
                            <i class="nav-icon mr-2 i-Split-Vertical"></i>
                            <span class="item-name">Add a Superlike package</span>
                        </a>
                    </li>
                       {{-- <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Completed Insurance</span>
                        </a>
                    </li>
  <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Split-Vertical"></i>
                            <span class="item-name">Cancelled Insurance</span> --}}
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="" href="listing.html/forms/form-input-group">
                            <i class="nav-icon mr-2 i-Receipt-4"></i>
                            <span class="item-name">Input Groups</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/forms/form-validation">
                            <i class="nav-icon mr-2 i-Close-Window"></i>
                            <span class="item-name">Form Validation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/forms/smartWizard">
                            <i class="nav-icon mr-2 i-Width-Window"></i>
                            <span class="item-name">Smart Wizard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/forms/tagInput">
                            <i class="nav-icon mr-2 i-Tag-2"></i>
                            <span class="item-name">Tag Input</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/forms/form-editor">
                            <i class="nav-icon mr-2 i-Pen-2"></i>
                            <span class="item-name">Rich Editor</span>
                        </a>
                    </li> -->
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- end Forms -->


                                <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

Charts
            </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Bar-Chart-5"></i> Boosts
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                          <li class="nav-item">
                        <a class="" href="/addboosts" title='charts'>
                            <i class="nav-icon mr-2 i-Bar-Chart-2"></i>
                            <span class="item-name">Add New Boosts</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="/showallboosts">
                            <i class="nav-icon mr-2 i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Show all boosts</span>
                        </a>
                    </li>


                          {{-- <li><a  class="" href="listing.html">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Completed Loan</a></li>
                          <li><a  class="" href="listing.html">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Cancelled Loan</a></li> --}}
                          <!-- <li><a  class="" href="listing.html/charts/apexBubbleCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Bubble </a></li>
                          <li><a  class="" href="listing.html/charts/apexColumnCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Column </a></li>
                          <li><a  class="" href="listing.html/charts/apexCandleStickCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>CandleStick </a></li>
                          <li><a  class="" href="listing.html/charts/apexLineCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Line </a></li>
                          <li><a  class="" href="listing.html/charts/apexMixCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Mix </a></li>
                          <li><a  class="" href="listing.html/charts/apexPieDonutCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>PieDonut </a></li>
                          <li><a  class="" href="listing.html/charts/apexRadarCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Radar </a></li>
                          <li><a  class="" href="listing.html/charts/apexRadialBarCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>RadialBar </a></li>
                          <li><a  class="" href="listing.html/charts/apexScatterCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Scatter </a></li>
                          <li><a  class="" href="listing.html/charts/apexSparklineCharts">  <i class="nav-icon mr-2 i-Bar-Chart-2"></i>Sparkline </a></li> -->

                                  </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- end charts -->
                            <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

UI kits
                                        </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Suitcase"></i> Lease
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                                           <li class="nav-item">
                    <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Bell1"></i>
                            <span class="item-name">Add new Lease</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Medal-2"></i>
                            <span class="item-name">Ongoing Lease</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Completed Lease</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Cancelled Lease</span>
                        </a>
                    </li>

                                        <!-- <li class="nav-item">
                        <a class="" href="listing.html/uikits/buttons">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Promotion Wise</span>
                        </a>
                    </li> -->
<!--                           <li class="nav-item">
                        <a class="" href="listing.html/uikits/accordion">
                            <i class="nav-icon mr-2 i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Accordion</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/lists">
                            <i class="nav-icon mr-2 i-Belt-3"></i>
                            <span class="item-name">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/pagination">
                            <i class="nav-icon mr-2 i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/popover">
                            <i class="nav-icon mr-2 i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/progressbar">
                            <i class="nav-icon mr-2 i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tabs">
                            <i class="nav-icon mr-2 i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tooltip">
                            <i class="nav-icon mr-2 i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/modals">
                            <i class="nav-icon mr-2 i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li> -->


                                        </ul>
                                    </div>
                                </div>
                            </li>

<!-- End of order -->
<li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

UI kits
                                        </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Suitcase"></i> Denting / Painting
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                                           <li class="nav-item">
                    <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Bell1"></i>
                            <span class="item-name">Add new Denting/Painting</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Medal-2"></i>
                            <span class="item-name">Ongoing Denting/Painting</span>
                        </a>
                    </li>
                    
                           <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Completed Denting/Painting</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Belt-3"></i>
                            <span class="item-name">Cancelled Denting/Painting</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="" href="listing.html/uikits/pagination">
                            <i class="nav-icon mr-2 i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/popover">
                            <i class="nav-icon mr-2 i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/progressbar">
                            <i class="nav-icon mr-2 i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tabs">
                            <i class="nav-icon mr-2 i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tooltip">
                            <i class="nav-icon mr-2 i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/modals">
                            <i class="nav-icon mr-2 i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li> -->
<!-- end of finance -->
                           
                          
                                                        


                                        </ul>
                                    </div>
                                </div>
                            </li>

                                                        <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

UI kits
                                        </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Suitcase"></i> Tickets
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

                                           <li class="nav-item">
                    <a class="" href="#">
                            <i class="nav-icon mr-2 i-Bell1"></i>
                            <span class="item-name">New</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Medal-2"></i>
                            <span class="item-name">Ongoing</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="listing.html">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Closed</span>
                        </a>
                    </li>
<!--                     <li class="nav-item">
                        <a class="" href="listing.html/uikits/buttons">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Cancelled</span>
                        </a>
                    </li> -->
<!--                           <li class="nav-item">
                        <a class="" href="listing.html/uikits/accordion">
                            <i class="nav-icon mr-2 i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Accordion</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/lists">
                            <i class="nav-icon mr-2 i-Belt-3"></i>
                            <span class="item-name">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/pagination">
                            <i class="nav-icon mr-2 i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/popover">
                            <i class="nav-icon mr-2 i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/progressbar">
                            <i class="nav-icon mr-2 i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tabs">
                            <i class="nav-icon mr-2 i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tooltip">
                            <i class="nav-icon mr-2 i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/modals">
                            <i class="nav-icon mr-2 i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li> -->


                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li class="">

                                <div>


                                    <div>
                                        <label class="toggle" for="drop-2">

UI kits
                                        </label>
                                        <a href="#">
                                            <i class="nav-icon mr-2 i-Suitcase"></i> Settings
                                        </a><input type="checkbox" id="drop-2">
                                        <ul>

<!--                                            <li class="nav-item">
                    <a class="" href="#">
                            <i class="nav-icon mr-2 i-Bell1"></i>
                            <span class="item-name">New</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/badges">
                            <i class="nav-icon mr-2 i-Medal-2"></i>
                            <span class="item-name">Ongoing</span>
                        </a>
                    </li>
                      <li class="nav-item">
                        <a class="" href="listing.html/uikits/bootstrap-tab">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Completed</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/buttons">
                            <i class="nav-icon mr-2 i-Cursor-Click"></i>
                            <span class="item-name">Cancelled</span>
                        </a>
                    </li> -->
<!--                           <li class="nav-item">
                        <a class="" href="listing.html/uikits/accordion">
                            <i class="nav-icon mr-2 i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Accordion</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/lists">
                            <i class="nav-icon mr-2 i-Belt-3"></i>
                            <span class="item-name">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/pagination">
                            <i class="nav-icon mr-2 i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/popover">
                            <i class="nav-icon mr-2 i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/progressbar">
                            <i class="nav-icon mr-2 i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tabs">
                            <i class="nav-icon mr-2 i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/tooltip">
                            <i class="nav-icon mr-2 i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="" href="listing.html/uikits/modals">
                            <i class="nav-icon mr-2 i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li> -->


                                        </ul>
                                    </div>
                                </div>
                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>

        </div>
        <!--=============== Horizontal bar End ================-->

        @yield('content')

        
                <!-- Footer Start -->
<div class="flex-grow-1"></div>
<div class="app-footer">
    <div class="row">
        <div class="col-md-9">
            <p><strong>Dating Strings</strong></p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero quis beatae officia saepe perferendis
                voluptatum minima eveniet voluptates dolorum, temporibus nisi maxime nesciunt totam repudiandae commodi
                sequi dolor quibusdam
                sunt.
            </p>
        </div>
    </div>
    <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
        <!-- <a class="btn btn-primary text-white btn-rounded" target="_blank"
            href="https://themeforest.net/item/gull-bootstrap-laravel-admin-dashboard-template/23101970?ref=ui-lib"
            target="_blank">Buy
            Gull HTML</a> -->
        <span class="flex-grow-1"></span>
        <div class="d-flex align-items-center">
            <img class="logo" src="../../dist-assets/images/Logo.png" alt="">
            <div>
                <p class="m-0">&copy; 2019 4-Chaki</p>
                <p class="m-0">All rights reserved</p>
            </div>
        </div>
    </div>
</div>
<!-- fotter end -->            </div>
            <!-- ============ Body content End ============= -->
        </div>
        <!--=============== End app-admin-wrap ================-->

        <!-- ============ Search UI Start ============= -->
        <!-- ============ Search UI Start ============= -->
  <div class="search-ui">
        <div class="search-header">
            <img src="listing.html/assets/images/logo.png" alt="" class="logo">
            <button class="search-close btn btn-icon bg-transparent float-right mt-2">
                <i class="i-Close-Window text-22 text-muted"></i>
            </button>
        </div>

        <input type="text" placeholder="Type here" class="search-input" autofocus>

        <div class="search-title">
            <span class="text-muted">Search results</span>
        </div>

        <div class="search-results list-horizontal">
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="listing.html/assets/images/products/headphone-1.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-danger">Sale</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="listing.html/assets/images/products/headphone-2.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">New</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="listing.html/assets/images/products/headphone-3.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">New</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="listing.html/assets/images/products/headphone-4.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">New</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- PAGINATION CONTROL -->
        <div class="col-md-12 mt-5 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination d-inline-flex">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- ============ Search UI End ============= -->
        <!-- ============ Search UI End ============= -->

        


        <!-- ============ Horizontal Layout End ============= -->




        <!-- ============ Vetical SIdebar Layout start ============= -->
        
        <!-- ============ Customizer ============= -->
<!-- <div class="customizer">
    <div class="handle" (click)="isOpen = !isOpen">
        <i class="i-Gear spin"></i>
    </div>
    <div class="customizer-body" data-perfect-scrollbar data-suppress-scroll-x="true">
        <div class="accordion" id="accordionCustomizer">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <p class="mb-0">
                        Sidebar Layout
                    </p>
                </div> -->

                

    <!-- <div class="card-body">
        <div class="layouts"> -->

            <!---->
            <!-- <div class="layout-box mb-4 ">
                <a href="listing.html/large-compact-sidebar/dashboard/dashboard1">
                    <img alt="" src="listing.html/assets/images/screenshots/02_preview.png" /><i class="i-Eye"></i>
                </a>
            </div>
            <div
                class="layout-box mb-4 ">
                <a href="listing.html/large-sidebar/dashboard/dashboard1">
                    <img alt="" src="listing.html/assets/images/screenshots/04_preview.png" /><i class="i-Eye"></i>
                </a>
            </div> -->
            <!-- <div class="layout-box mb-4 active">
                <a href="listing.html/horizontal-bar/dashboard/dashboard1">
                    <img alt="" src="listing.html/assets/images/screenshots/horizontal.png" /><i class="i-Eye"></i>
                </a>
            </div>
            <div class="layout-box mb-4 mt-30 ">
                <a href="listing.html/vertical/dashboard/dashboard1">
                    <span class="badge badge-danger p-1">New</span>

                    <img alt="" src="listing.html/assets/images/screenshots/verticallayout.png" />

                    <i class="i-Eye"></i>
                </a>
            </div>
        </div>
        <div class="text-center pt-3">More layouts coming...</div>
    </div>
    <div class="card d-none">
        <div class="card-header" id="headingOne">
            <p class="mb-0">
                Sidebar Colors
            </p>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionCustomizer">
            <div class="card-body">
                <div class="colors sidebar-colors">
                    <a class="color gradient-purple-indigo" data-sidebar-class="sidebar-gradient-purple-indigo">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color gradient-black-blue" data-sidebar-class="sidebar-gradient-black-blue">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color gradient-black-gray" data-sidebar-class="sidebar-gradient-black-gray">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color gradient-steel-gray" data-sidebar-class="sidebar-gradient-steel-gray">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color dark-purple active" data-sidebar-class="sidebar-dark-purple">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color slate-gray" data-sidebar-class="sidebar-slate-gray">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color midnight-blue" data-sidebar-class="sidebar-midnight-blue">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color blue" data-sidebar-class="sidebar-blue">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color indigo" data-sidebar-class="sidebar-indigo">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color pink" data-sidebar-class="sidebar-pink">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color red" data-sidebar-class="sidebar-red">
                        <i class="i-Eye"></i>
                    </a>
                    <a class="color purple" data-sidebar-class="sidebar-purple">
                        <i class="i-Eye"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" id="headingTwo">
        <p class="mb-0">
            RTL
        </p>
    </div>

    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionCustomizer">
        <div class="card-body">
            <label class="checkbox checkbox-primary">
                <input type="checkbox" id="rtl-checkbox">
                <span>Enable RTL</span>
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header" id="headingTwo">
        <p class="mb-0">
            Dark Version
        </p>
    </div>

    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionCustomizer">
        <div class="card-body">
            <label class="checkbox checkbox-primary">
                <input type="checkbox" id="dark-checkbox">
                <span>Enable Dark Mode</span>
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
</div>


</div>
</div>
</div> -->
<!-- ============ End Customizer ============= -->       


    <script src="../../dist-assets/js/plugins/jquery-3.3.1.min.js"></script>
    <script src="../../dist-assets/js/plugins/bootstrap.bundle.min.js"></script>
    <script src="../../dist-assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../dist-assets/js/scripts/script.min.js"></script>
    <script src="../../dist-assets/js/scripts/sidebar.large.script.min.js"></script>
    <script src="../../dist-assets/js/plugins/echarts.min.js"></script>
    <script src="../../dist-assets/js/scripts/echart.options.min.js"></script>
    <script src="../../dist-assets/js/plugins/datatables.min.js"></script>
    <script src="../../dist-assets/js/scripts/dashboard.v1.script.min.js"></script>
    <script src="../../dist-assets/js/scripts/customizer.script.min.js"></script>
 
    </body>

</html>