<?php
include "../../../../connection.php";


?>
<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['type']) == 1) {
	$why_choose = "";
	$customer_support = "";
	$best_price = "";
	$location = "";
	$cancelation = "";
	
	
	$sql = "SELECT * FROM `about_us`";
	$result = mysqli_query($connection, $sql);
	
	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
	
		$why_choose = $row['why_choose'];
		$customer_support = $row['customer_support'];
		$best_price = $row['best_price'];
		$location = $row['location'];
		$cancelation = $row['cancelation'];
	}
	
	$errors = array(
		'why_choose' => '',
		'customer_support' => '',
		'best_price' => '',
		'location' => '',
		'cancelation' => '',
	);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$why_choose = $_POST["why_choose"];
		$customer_support = $_POST["customer_support"];
		$best_price = $_POST["best_price"];
		$location = $_POST["location"];
		$cancelation = $_POST["cancelation"];
	
		do {
	
			if (empty($why_choose)) {
				$errors['why_choose'] = "Plese enter your customer why choose us";
			}
	
			if (empty($customer_support)) {
				$errors['customer_support'] = "Plese enter your customer support";
			}
	
	
			if (empty($best_price)) {
				$errors['best_price'] = "Plese enter your best price";
			}
	
			if (empty($location)) {
				$errors['location'] = "Plese enter your location";
			}
	
			if (empty($cancelation)) {
				$errors['cancelation'] = "Please enter your cancelation.";
			}
	
			if (empty($errors['cancelation']) && empty($errors['location']) && empty($errors['best_price']) && empty($errors['customer_support']) && empty($errors['why_choose'])) {
				$sql = "UPDATE `about_us` SET `why_choose`='$why_choose',`customer_support`='$customer_support',`best_price`='$best_price',`location`='$location',`cancelation`='$cancelation'";
				$result = mysqli_query($connection, $sql);
			}
	
			if (!$result) {
				echo "invaled query";
			}
		} while (false);
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Metronic | Dashboard</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <link href="assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!--end:: Vendor Plugins -->
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--begin:: Vendor Plugins for custom pages -->
    <link href="assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/@fullcalendar/core/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/@fullcalendar/daygrid/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/@fullcalendar/list/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/@fullcalendar/timegrid/main.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/jqvmap/dist/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/uppy/dist/uppy.min.css" rel="stylesheet" type="text/css" />

    <!--end:: Vendor Plugins for custom pages -->

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />


    <!-- my css  -->
    <link rel="stylesheet" href="assets/css/mystyle.css">
    <link rel="stylesheet" href="assets/css/cssimg.css">
    <link rel="stylesheet" href="assets/css/asdasdasdasd.css">


    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="../../../../images/logo/logo.png" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="../../../../../car rental/Home.php">
                <img alt="Logo" src="../../../../images/logo/logo.png" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Aside -->

            <!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->
            <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                <!-- begin:: Aside -->
                <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                    <div class="kt-aside__brand-logo">
                        <a href="../../../../Home.php">
                            <img alt="Logo" src="../../../../images/logo/logo.png" class="i1" />
                        </a>
                    </div>
                    <div class="kt-aside__brand-tools">
                        <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                    </g>
                                </svg></span>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                                    </g>
                                </svg></span>
                        </button>

                        <!--
			<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
			-->
                    </div>
                </div>

                <!-- end:: Aside -->

                <!-- begin:: Aside Menu -->
                <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item  " aria-haspopup="true"><a href="index.php" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg></span><span class="kt-menu__link-text">Dashboard</span></a>
                            </li>

                            <li class="kt-menu__item " aria-haspopup="true"><a href="./car.php" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg></span><span class="kt-menu__link-text">cars</span></a>
                            </li>

                            <li class="kt-menu__item  " aria-haspopup="true"><a href="user.php" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg></span><span class="kt-menu__link-text">users</span></a>
                            </li>

                            <li class="kt-menu__item   kt-menu__item--active" aria-haspopup="true"><a href="aboutus.php" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg></span><span class="kt-menu__link-text">aboutus</span></a>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- end:: Aside Menu -->
            </div>

            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->

						<!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">

							</div>
						</div>

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">



							<!--begin: Notifications -->
							<div class="kt-header__topbar-item dropdown">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
								

	
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
									<form>

										<!--begin: Head -->
										<div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url(assets/media/misc/bg-1.jpg)">
											<h3 class="kt-head__title">
												User Notifications
												&nbsp;
												<span class="btn btn-success btn-sm btn-bold btn-font-md">23 new</span>
											</h3>
											<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
												<li class="nav-item">
													<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Alerts</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Events</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
												</li>
											</ul>
										</div>

										<!--end: Head -->
										<div class="tab-content">
											<div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
												<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-line-chart kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New order has been received
															</div>
															<div class="kt-notification__item-time">
																2 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-box-1 kt-font-brand"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New customer is registered
															</div>
															<div class="kt-notification__item-time">
																3 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-chart2 kt-font-danger"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Application has been approved
															</div>
															<div class="kt-notification__item-time">
																3 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-image-file kt-font-warning"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New file has been uploaded
															</div>
															<div class="kt-notification__item-time">
																5 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-drop kt-font-info"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New user feedback received
															</div>
															<div class="kt-notification__item-time">
																8 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-pie-chart-2 kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																System reboot has been successfully completed
															</div>
															<div class="kt-notification__item-time">
																12 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-favourite kt-font-danger"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New order has been placed
															</div>
															<div class="kt-notification__item-time">
																15 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item kt-notification__item--read">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-safe kt-font-primary"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Company meeting canceled
															</div>
															<div class="kt-notification__item-time">
																19 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-psd kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New report has been received
															</div>
															<div class="kt-notification__item-time">
																23 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon-download-1 kt-font-danger"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Finance report has been generated
															</div>
															<div class="kt-notification__item-time">
																25 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon-security kt-font-warning"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New customer comment recieved
															</div>
															<div class="kt-notification__item-time">
																2 days ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-pie-chart kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New customer is registered
															</div>
															<div class="kt-notification__item-time">
																3 days ago
															</div>
														</div>
													</a>
												</div>
											</div>
											<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
												<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-psd kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New report has been received
															</div>
															<div class="kt-notification__item-time">
																23 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon-download-1 kt-font-danger"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Finance report has been generated
															</div>
															<div class="kt-notification__item-time">
																25 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-line-chart kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New order has been received
															</div>
															<div class="kt-notification__item-time">
																2 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-box-1 kt-font-brand"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New customer is registered
															</div>
															<div class="kt-notification__item-time">
																3 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-chart2 kt-font-danger"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Application has been approved
															</div>
															<div class="kt-notification__item-time">
																3 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-image-file kt-font-warning"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New file has been uploaded
															</div>
															<div class="kt-notification__item-time">
																5 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-drop kt-font-info"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New user feedback received
															</div>
															<div class="kt-notification__item-time">
																8 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-pie-chart-2 kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																System reboot has been successfully completed
															</div>
															<div class="kt-notification__item-time">
																12 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-favourite kt-font-brand"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New order has been placed
															</div>
															<div class="kt-notification__item-time">
																15 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item kt-notification__item--read">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-safe kt-font-primary"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Company meeting canceled
															</div>
															<div class="kt-notification__item-time">
																19 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-psd kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New report has been received
															</div>
															<div class="kt-notification__item-time">
																23 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon-download-1 kt-font-danger"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																Finance report has been generated
															</div>
															<div class="kt-notification__item-time">
																25 hrs ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon-security kt-font-warning"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New customer comment recieved
															</div>
															<div class="kt-notification__item-time">
																2 days ago
															</div>
														</div>
													</a>
													<a href="#" class="kt-notification__item">
														<div class="kt-notification__item-icon">
															<i class="flaticon2-pie-chart kt-font-success"></i>
														</div>
														<div class="kt-notification__item-details">
															<div class="kt-notification__item-title">
																New customer is registered
															</div>
															<div class="kt-notification__item-time">
																3 days ago
															</div>
														</div>
													</a>
												</div>
											</div>
											<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
												<div class="kt-grid kt-grid--ver" style="min-height: 200px;">
													<div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
														<div class="kt-grid__item kt-grid__item--middle kt-align-center">
															All caught up!
															<br>No new notifications.
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>


							<div class="kt-header__topbar-item dropdown">
								
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
									<form>

										<!--begin: Head -->
										<div class="kt-head kt-head--skin-dark" style="background-image: url(assets/media/misc/bg-1.jpg)">
											<h3 class="kt-head__title">
												User Quick Actions
												<span class="kt-space-15"></span>
												<span class="btn btn-success btn-sm btn-bold btn-font-md">23 tasks
													pending</span>
											</h3>
										</div>

										<!--end: Head -->

										
									</form>
								</div>
							</div>

							<!--end: Quick Actions -->


							

							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile">
										<?php echo $_SESSION['f_name'] . $_SESSION['l_name'] ?>
										</span>
										<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

									<!--begin: Head -->
									<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">
										<div class="kt-user-card__avatar">
											<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

											<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
											<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
										</div>
										<div class="kt-user-card__name">
											<?php echo $_SESSION['f_name'] . $_SESSION['l_name'] ?>
										</div>
										<div class="kt-user-card__badge">
											<span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
										</div>
									</div>

									<!--end: Head -->

									<!--begin: Navigation -->
									<div class="kt-notification">
										<a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-calendar-3 kt-font-success"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													My Profile
												</div>
												<div class="kt-notification__item-time">
													Account settings and more
												</div>
											</div>
										</a>
										<a href="custom/apps/user/profile-3.html" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-mail kt-font-warning"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													My Messages
												</div>
												<div class="kt-notification__item-time">
													Inbox and tasks
												</div>
											</div>
										</a>
										<a href="custom/apps/user/profile-2.html" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-rocket-1 kt-font-danger"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													My Activities
												</div>
												<div class="kt-notification__item-time">
													Logs and notifications
												</div>
											</div>
										</a>
										<a href="custom/apps/user/profile-3.html" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-hourglass kt-font-brand"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													My Tasks
												</div>
												<div class="kt-notification__item-time">
													latest tasks and projects
												</div>
											</div>
										</a>
										<a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-cardiogram kt-font-warning"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													Billing
												</div>
												<div class="kt-notification__item-time">
													billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2
														pending</span>
												</div>
											</div>
										</a>
										<div class="kt-notification__custom kt-space-between">
											<a href="../../../../logout.php" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
										</div>
									</div>

									<!--end: Navigation -->
								</div>
							</div>

							<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                    <!-- begin:: Content Head -->
                    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-subheader__main">
                                <h3 class="kt-subheader__title">Aboutus</h3>
                                <span class="kt-subheader__separator kt-subheader__separator--v"></span>


                            </div>

                        </div>
                    </div>

                    <!-- end:: Content Head -->






                    <!-- begin:: Content -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                        <!-- start my content -->
                        <!--begin::Portlet-->
                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        <i class="la la-plus-circle"></i>
                                        Update
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-group">
                                        <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-angle-down"></i></a>

                                    </div>
                                </div>
                            </div>



                            <div class="kt-portlet__body">
                                <div class="kt-portlet__content">
                                    <form method="post" class="addcour-form" id="form">

                                        <div class="row">
                                            <!-- start col -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="lll">WHY CHOOSE US</label>
                                                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="why_choose" name="why_choose"><?php echo $why_choose; ?></textarea>
                                                    <p class="text-danger"><?php echo $errors['why_choose']; ?></p>
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <!-- start col -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="lll">Customer Support</label>
                                                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="Customer Support" name="customer_support"><?php echo $customer_support; ?></textarea>
                                                    <p class="text-danger"><?php echo $errors['customer_support']; ?></p>
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <!-- start col -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="lll">Best Price</label>
                                                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="Best Price" name="best_price"><?php echo $best_price; ?></textarea>
                                                    <p class="text-danger"><?php echo $errors['best_price']; ?></p>
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <!-- start col -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="lll">Location</label>
                                                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="Location" name="location"><?php echo $location; ?></textarea>
                                                    <p class="text-danger"><?php echo $errors['location']; ?></p>
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <!-- start col -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="lll">Free Cancelation</label>
                                                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="Free Cancelation" name="cancelation"><?php echo $cancelation; ?></textarea>
                                                    <p class="text-danger"><?php echo $errors['cancelation']; ?></p>
                                                </div>
                                            </div>
                                            <!-- end col -->


                                            <!-- start col -->
                                            <div class="col-lg-6 hh">
                                                <div class="form-group hhh">
                                                    <button type="submit" class="btn btn-bold btn-label-brand btn-md hhhh col-lg-6">Update</button>
                                                </div>
                                            </div>
                                            <!-- end col -->


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--end::Portlet-->



                        <!-- end my content -->
                    </div>

                    <!-- end:: Content -->
                </div>

                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
                        </div>
                        <div class="kt-footer__menu">
                            <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                            <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                            <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                        </div>
                    </div>
                </div>

                <!-- end:: Footer -->
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>

    <!-- end::Scrolltop -->




    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <script src="assets/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="assets/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
    <script src="assets/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
    <script src="assets/plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/wnumb/wNumb.js" type="text/javascript"></script>
    <script src="assets/plugins/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
    <script src="assets/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
    <script src="assets/plugins/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
    <script src="assets/plugins/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
    <script src="assets/plugins/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
    <script src="assets/plugins/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
    <script src="assets/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
    <script src="assets/plugins/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
    <script src="assets/plugins/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="assets/plugins/general/autosize/dist/autosize.js" type="text/javascript"></script>
    <script src="assets/plugins/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/dropzone.init.js" type="text/javascript"></script>
    <script src="assets/plugins/general/quill/dist/quill.js" type="text/javascript"></script>
    <script src="assets/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
    <script src="assets/plugins/general/markdown/lib/markdown.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js" type="text/javascript"></script>
    <script src="assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
    <script src="assets/plugins/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/toastr/build/toastr.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
    <script src="assets/plugins/general/raphael/raphael.js" type="text/javascript"></script>
    <script src="assets/plugins/general/morris.js/morris.js" type="text/javascript"></script>
    <script src="assets/plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
    <script src="assets/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/plugins/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
    <script src="assets/plugins/general/counterup/jquery.counterup.js" type="text/javascript"></script>
    <script src="assets/plugins/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
    <script src="assets/plugins/general/js/global/integration/plugins/sweetalert2.init.js" type="text/javascript">
    </script>
    <script src="assets/plugins/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
    <script src="assets/plugins/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
    <script src="assets/plugins/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
    <script src="assets/plugins/general/dompurify/dist/purify.js" type="text/javascript"></script>

    <!--end:: Vendor Plugins -->
    <script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

    <!--begin:: Vendor Plugins for custom pages -->
    <script src="assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/js/global/integration/plugins/datatables.init.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jszip/dist/jszip.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-buttons/js/buttons.colVis.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-buttons/js/buttons.flash.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-buttons/js/buttons.print.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/datatables.net-select/js/dataTables.select.min.js" type="text/javascript">
    </script>
    <script src="assets/plugins/custom/jstree/dist/jstree.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jqvmap/dist/jquery.vmap.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/uppy/dist/uppy.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/tinymce/themes/silver/theme.js" type="text/javascript"></script>
    <script src="assets/plugins/custom/tinymce/themes/mobile/theme.js" type="text/javascript"></script>

    <!--end:: Vendor Plugins for custom pages -->

    <!--end::Global Theme Bundle -->
    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="assets/js/pages/dashboard.js" type="text/javascript"></script>
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="assets/js/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>
    <script src="assets/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>
    <script src="assets/js/pages/crud/metronic-datatable/advanced/modal.js" type="text/javascript"></script>

    <!--end::Page Scripts -->


</body>

<!-- end::Body -->

</html>
<?php
} else {
    header("Location: ../../../../signIn.php");
    exit;
}
?>