<?php /*Template Name:careers_listing*/ ?>
<?php
get_header();
include('statecode.php');
?>
<style>
  /*Hawx-Careers page style*/
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .loading-container {
    position: absolute;
    background-color: #F5F7F7;
    width: 100vw;
    height: 100vh;
    top: 0;
    bottom: 0;
    z-index: 9999;
  }

  .loading-container .loading {
    position: absolute;
    left: 45%;
    right: 50%;
    top: 45%;
    z-index: 1;
    width: 50px;
    height: 50px;
    border: 6px solid #F5F7F7;
    border-radius: 50%;
    border-top: 6px solid #637675;
    -webkit-animation: spin 1.2s cubic-bezier(.5, 0, .5, 1) infinite;
    animation: spin 1.2s cubic-bezier(.5, 0, .5, 1) infinite;
  }

  .careers-search-container,
  .job-filter-list-container,
  .careers-job-list-container {
    display: none;
  }

  /*Banner-search*/
  .careers-search {
    max-width: 1140px;
    margin: auto;
  }

  /*filter your search-Division */
  .careers-filter {
    border-bottom: 2px solid #E8EBEB;
  }

  .outer-filter-tile {
    display: flex;
    max-width: 1100px;
    margin: auto;
    font-size: 24px;
    font-weight: 700;
    padding: 3% 0%;
  }

  .outer-filter-tile p {
    margin: 0;
    padding-left: 10px;
  }

  .outer-filter-tile svg {
    /* cursor: pointer; */
    padding: 8px 0 0 0;
    margin: 0 12px 0 0;
  }

  .outer-filter-tile svg path {
    fill: #637675;
  }

  .outer-filter-tile .form-filter svg path {
    fill: #888888;
  }

  .careers-filter-state-search,
  .careers-filter-cat-search {
    position: relative;
  }

  .inactive {
    display: none !important;
  }

  .active {
    display: initial !important;
  }

  .form-filter {
    display: flex;
  }

  .form-filter svg {
    pointer-events: none;
    position: absolute;
    padding: 16px 0 0 0;
    right: 12px;
    margin: 4px 10px 0 0;
  }

  /* Select drop-down option on filter section*/
  .select2-container {
    /* border: 1px solid #f5f7f7; */
    border-radius: 5px;
    background-color: #f5f7f7;
    cursor: pointer !important;
    width: 212px !important;
    margin: 0 12px !important;
    top: 0 !important;
  }

  .select2-dropdown {
    border: 1px solid #DADADA !important;
  }

  /* .select2-search {
    display: none;
  } */

  .select2-container--focus {
    border: 1px solid #DADADA !important;
    border-radius: 5px;
    background-color: #f5f7f7;
  }

  .select2-results__option:before {
    content: "";
    display: inline-block;
    position: relative;
    height: 14px;
    width: 14px;
    border-radius: 2px;
    border: 2px solid #161c1c;
    background-color: #fff;
    margin-right: 10px;
    vertical-align: middle;
  }

  .select2-results__option[aria-selected=true]:before {
    /* font-family: fontAwesome;
    content: "\f14a";
    color: #fff;
    font-weight: 100 !important;
    background-color: #637675;
    border: 2px;
    display: inline-block;
    padding: 0px 3px;
    font-size: 9px; */
    font-family: fontAwesome;
    content: "\f14a";
    color: #637675;
    /* font-weight: 100 !important; */
    background-color: #ffffff;
    border: 2px;
    bottom: 8px;
    /* display: inline-block; */
    /* padding: 0px 3px; */
    font-size: 16px;
  }

  .select2-container--default .select2-results__option[aria-selected=true] {
    background-color: transparent !important;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
  }

  .select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: transparent !important;
    color: #161c1c !important;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
  }

  .select2-container--default .select2-selection--multiple {
    cursor: pointer !important;
    max-width: 212px;
    background-color: #F5F7F7 !important;
    border: 1px solid #F5F7F7 !important;
    border-radius: 5px !important;
    padding: 0% 3%;
    height: 48px !important;
    font-size: 10px;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    cursor: pointer;
  }

  .select2-selection--multiple .select2-search__field {
    width: 100% !important;
    cursor: pointer;
    font-size: 15px !important;
    margin-top: 0 !important;
  }

  .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
    border-radius: 4px;
  }

  .select2-container--default.select2-container--focus .select2-selection--multiple {
    width: 100%;
    font-size: 10px;
  }

  .select2-container--default .select2-results>.select2-results__options {
    max-height: 342px !important;
  }

  .select2-container--default .select2-results>.select2-results__options li:last-child {
    border: none;
  }

  .select2-results__option {
    font-size: 15px;
    font-weight: 600;
    margin-left: 1px;
    padding: 10px 0px 10px 16px !important;
  }

  .select2-results__option[aria-selected] {
    font-size: 15px;
    font-weight: 600;
    border-bottom: 1px solid #E8EBEB;
  }

  .select2-dropdown {
    z-index: 1 !important;
  }

  .select2-container--open .select2-dropdown--below,
  .select2-container--open .select2-dropdown--above {
    position: absolute;
    border-radius: 5px;
    width: 212px !important;
    left: -12px !important;
  }

  .select2-container--open .select2-dropdown--below {
    top: 47px;
  }

  .select2-container--open .select2-dropdown--above {
    bottom: -2px !important;
  }

  .select2-container--default .select2-selection--multiple {
    display: flex !important;
    align-items: center !important;
  }

  .select2-container .select2-search {
    position: absolute;
    top: 10px;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__rendered {
    /* display: flex !important; */
    font-size: 15px !important;
    font-weight: 600 !important;
    width: 85% !important;
    padding: 0 10px !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__rendered input::placeholder {
    font-weight: 600;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    border: none !important;
    background-color: inherit !important;
    font-size: 15px !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    display: none !important;
  }

  .clear-all-selection {
    cursor: pointer !important;
    color: #888888;
    text-decoration: underline;
    font-size: 15px;
    margin: 1%;
    font-weight: 600;
    display: none;
  }

  /*End of filter your search-Division */
  /*job-listing - division*/
  .careers-job-list-container {
    width: 100%;
  }

  .careers-job-list-container .careers-job-list {
    display: flex;
    justify-content: center;
    flex-direction: column;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data {
    justify-content: center;
    border-bottom: 2px solid #E8EBEB;
    display: none;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post {
    max-width: 1100px;
    padding: 5% 0;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-heading a {
    font-weight: 700;
    color: #637675;
    font-size: 40px;
    text-decoration: none;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-address {
    display: flex;
    color: #161C1C;
    font-size: 24px;
    font-weight: 600;
    padding: 1% 0;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-address strong {
    display: flex;
    font-weight: 600 !important;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-address p {
    margin: 0 0 0 8px;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-address svg {
    margin: auto 0;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-description {
    color: #161C1C;
    font-size: 15px;
    line-height: 32px;
    padding: 1% 0;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-description p,
  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-description p strong {
    font-weight: 400;
    margin: 0;
  }

  .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-description ul {
    padding: 0 2%;
  }

  /*Load More division*/
  .careers-loadmore-section {
    text-align: center;
    padding: 4% 0;
  }

  .careers-loadmore-section .careers-loadmore-button span {
    cursor: pointer;
    font-size: 24px;
    color: #EAB749;
    font-weight: 800;
    text-decoration: underline;
  }

  .not-found-text-loadmore {
    text-align: center;
    padding: 8% 0;
    font-size: 16px;
  }

  .show-more-job {
    display: flex !important;
  }

  /*End of Load More division*/
  /*End of job-listing - division*/
  .select2-container ::-webkit-scrollbar {
    width: 6px;
  }

  /* Track */
  .select2-container ::-webkit-scrollbar-track {
    background: #ffffff;
    border-radius: 10px;
  }

  /* Handle */
  .select2-container ::-webkit-scrollbar-thumb {
    background: #B8B8B8;
    border-radius: 10px;
  }

  /* Handle on hover */
  .select2-container ::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  /*Mobile Response - styles */
  @media (max-width:767px) {

    .loading-container {
      height: 120vh;
    }

    /*Banner section*/
    .careers-search-container {
      padding: 15% 0;
    }

    /*filter section*/
    .outer-filter-tile {
      font-size: 18px;
      padding: 20px;
      flex-direction: column;
    }

    .outer-filter-tile svg {
      margin: 10px 0px;
      padding: 0;
      width: 24px;
      height: 24px;
    }

    .form-filter {
      display: flex;
      flex-direction: column;
    }

    .outer-filter-tile .form-filter svg {
      position: absolute;
      padding: 7px 6px 6px;
      right: 0;
      left: 170px;
      margin: 5px 10px 0 0;
    }

    /* filter */
    .careers-filter-state-search,
    .careers-filter-cat-search {
      margin: 10px 0;
      width: 85%;
    }

    /*Job list section*/
    /*job data listing section */
    .careers-job-list-container {
      width: 100%;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data {
      padding: 20px;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-heading a {
      font-size: 20px;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-address {
      font-size: 13px;
      padding: 5% 0;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-address svg {
      height: 21px;
      width: 21px;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-description {
      font-size: 13px;
      line-height: 26px;
      padding: 1% 0;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-description ul {
      padding-left: 6%;
    }

    /*load more section*/
    .careers-loadmore-section {
      padding: 7% 0;
    }

    .careers-loadmore-section .careers-loadmore-button span {
      font-size: 20px;
    }

    /* Select drop-down option on filter section*/
    /* .select2-container {
      min-width: 55%;
    }

    .select2-results__option:before {
      content: "";
      display: inline-block;
      position: relative;
      height: 17px;
      width: 17px;
      border: 1.5px solid #161c1c;
      background-color: #fff;
      margin-right: 15px;
      vertical-align: middle;
    }
   */
    .select2-container {
      width: 200px !important;
      margin: 0 !important;
    }

    .select2-container--default .select2-results>.select2-results__options {
      max-height: 200px !important;
    }

    .select2-results__option[aria-selected=true]:before {
      padding: 0px 0px;
    }

    /*
    .select2-container--default .select2-results__option[aria-selected=true] {
      background-color: #f5f7f7 !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
      background-color: #fff !important;
      color: #161c1c !important;
    }
   */
    .select2-container--default .select2-selection--multiple {
      height: 33px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
      font-size: 13px !important;
    }


    .select2-selection--multiple .select2-search__field {
      font-size: 13px !important;
    }

    .select2-results__option {
      padding: 5px 0px 5px 15px !important;
    }

    .select2-container .select2-search {
      position: absolute;
      top: 5px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      font-size: 13px !important;
    }

    /*
    .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
      border-radius: 4px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
      width: 100%;
      font-size: 10px;
    }
   */
    .select2-results__option[aria-selected] {
      font-size: 13px;
    }

    /*
    .select2-dropdown {
      z-index: 0 !important;
    }
   */
    .select2-container--open .select2-dropdown--below,
    .select2-container--open .select2-dropdown--above {
      left: 0px !important;
      width: 200px !important;
    }
    .select2-container--open .select2-dropdown--below{
      top: 31px;
    }
   
    .clear-all-selection {
      font-size: 13px;
      width: fit-content;
    }
  }

  /*Tablet Response - styles */
  @media (min-width: 768px) and (max-width: 1024px) {
    .careers-filter .careers-filter-heading {
      justify-content: flex-start;
      margin-top: 8%;
    }

    .careers-filter .careers-filter-heading p {
      padding-left: 3%;
    }

    .careers-filter .careers-filter-category,
    .careers-filter .careers-filter-state {
      padding: 0% 0% 0 12%;
    }

    .careers-filter .careers-filter-category {
      padding-top: 8%;
    }

    .careers-filter .careers-filter-state h1,
    .careers-filter .careers-filter-category h1 {
      font-size: 22px;
    }

    .outer-filter-tile {
      padding: 20px;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data {
      padding: 0 20px;
    }

    .careers-job-list-container .careers-job-list .careers-job-list-data .careers-job-post .careers-job-post-heading a {
      font-size: 30px;
    }

    /* select2 */
    .select2-container--open .select2-dropdown--below{
      top: 47px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
      width: 81% !important;
    }

    .select2-container--default .select2-results>.select2-results__options {
      max-height: 200px !important;
    }

    .clear-all-selection {
      padding: 3px;
    }

    .not-found-text-loadmore {
      height: 32vh;
    }
  }
</style>
<!-- Database connection & fetching data -->
<?php
//search bar filter query on banner
$filterString = str_replace("And", "&", ucwords(strtolower($_GET["search-loc-role"])));
$stateCode = $states[$filterString];
$searchKey = strtoupper(($stateCode != '') ? $stateCode : $filterString);
$stringValue = (strlen($searchKey) > 2) ? $searchKey : '#';
if ($searchKey != '') {
  if ($searchKey == "US" || $searchKey == "UNITED STATES" || $searchKey == "USA") {
    $query_data = $query_data;
  } else {
    $query_data .= " WHERE Country_sub_name Like '" . $searchKey . "'" . " OR " . "Dept_name Like '" . $stringValue  . "%'" . " OR " . "City Like '" . $stringValue . "%'" . " OR " . "Position_title Like '%" . $stringValue . "%'";
  }
}
//Getting DB Records for listing
$table_data = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "career " . $query_data);
$table_dept = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "career ");
$positionCat = array();
foreach ($table_dept as $catPosition) {
  $positionCat[] = $catPosition->Dept_name;
  $positionCat = array_unique($positionCat);
}

// echo print_r($positionCat);
?>
<!-- End of Database connection & fetching data -->
<!-- career filter page container-->
<div class="careers-listing-page" style="width: 100%">
  <div class="loading-container">
    <div class="loading">
    </div>
  </div>
  <!-- Explore open role section -->
  <div class="careers-search-container">
    <div class="careers-search">
      <h1 class="careers-search-heading">Explore Open Roles</h1>
      <form class="careers-search-section" method="GET">
        <div class="careers-search-bar">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.4998 17.8333L13.7615 14.0883M15.8332 9.08333C15.8332 10.9619 15.0869 12.7636 13.7585 14.092C12.4301 15.4204 10.6285 16.1667 8.74984 16.1667C6.87122 16.1667 5.06955 15.4204 3.74116 14.092C2.41278 12.7636 1.6665 10.9619 1.6665 9.08333C1.6665 7.20472 2.41278 5.40304 3.74116 4.07466C5.06955 2.74628 6.87122 2 8.74984 2C10.6285 2 12.4301 2.74628 13.7585 4.07466C15.0869 5.40304 15.8332 7.20472 15.8332 9.08333Z" stroke="#888888" stroke-width="2" stroke-linecap="round" />
          </svg>
          <input type="text" name="search-loc-role" id="txtName" placeholder="Search Role or Location">
        </div>
        <button id="btnCheck" type="submit">Search</button>
      </form>
      <div class="errorbtn"></div>
    </div>
  </div>
  <!-- End of Explore open role section -->
  <!-- Filter your search section -->


  <!--End of Filter your search section -->
  <!--Filter and List section -->
  <div class="job-filter-list-container">
    <!--Filter section -->
    <div class="careers-filter">
      <div class="outer-filter-tile">
        <svg width="36" height="37" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 17V19H9V17H3ZM3 5V7H13V5H3ZM13 21V19H21V17H13V15H11V21H13ZM7 9V11H3V13H7V15H9V9H7ZM21 13V11H11V13H21ZM15 9H17V7H21V5H17V3H15V9Z" fill="black" />
        </svg>
        <form action="<?php echo get_permalink(); ?>" method="POST" class="form-filter" id="form-filter">
          <div class="careers-filter-state-search">
            <select class="js-select1" name="mob-filter-state[]" multiple="multiple" id="normal">
              <?php foreach ($states as $key => $value) {
                if ($value == $searchKey) {
                  $toCheck = "selected";
                } else {
                  $toCheck = '';
                } ?>
                <option value="<?php echo $value; ?>" data-badge="" <?php echo $toCheck; ?>><?php echo $key; ?></option>
              <?php
              } ?>
            </select>
            <svg class="opener active" width="25" height="25" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2.29866 0.392617L7.50671 5.60067L12.7148 0.392617C13.2383 -0.130872 14.0839 -0.130872 14.6074 0.392617C15.1309 0.916107 15.1309 1.76174 14.6074 2.28523L8.44631 8.44631C7.92282 8.9698 7.07718 8.9698 6.55369 8.44631L0.392617 2.28523C-0.130872 1.76174 -0.130872 0.916107 0.392617 0.392617C0.916107 -0.11745 1.77517 -0.130872 2.29866 0.392617Z" fill="#888888" />
            </svg>
            <svg class="closer inactive" width="25" height="25" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.7013 8.44625L7.49329 3.2382L2.28524 8.44625C1.76175 8.96974 0.916108 8.96974 0.392618 8.44625C-0.130872 7.92276 -0.130872 7.07712 0.392618 6.55363L6.55369 0.392559C7.07718 -0.130931 7.92282 -0.130931 8.44631 0.392559L14.6074 6.55363C15.1309 7.07712 15.1309 7.92276 14.6074 8.44625C14.0839 8.95632 13.2248 8.96974 12.7013 8.44625Z" fill="#888888" />
            </svg>
          </div>
          <div class="careers-filter-cat-search">
            <select class="js-select2" name="mob-filter-cat[]" multiple="multiple">
              <?php foreach ($positionCat as $cat) {
                if ($cat == ucwords(strtolower($searchKey))) {
                  $toCheck = "selected";
                } else {
                  $toCheck = '';
                } ?>
                <option value="<?php echo $cat; ?>" data-badge="" <?php echo $toCheck; ?>><?php echo $cat; ?></option>
              <?php } ?>
            </select>
            <svg class="opener-c active" width="25" height="25" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2.29866 0.392617L7.50671 5.60067L12.7148 0.392617C13.2383 -0.130872 14.0839 -0.130872 14.6074 0.392617C15.1309 0.916107 15.1309 1.76174 14.6074 2.28523L8.44631 8.44631C7.92282 8.9698 7.07718 8.9698 6.55369 8.44631L0.392617 2.28523C-0.130872 1.76174 -0.130872 0.916107 0.392617 0.392617C0.916107 -0.11745 1.77517 -0.130872 2.29866 0.392617Z" fill="#888888" />
            </svg>
            <svg class="closer-c inactive" width="25" height="25" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.7013 8.44625L7.49329 3.2382L2.28524 8.44625C1.76175 8.96974 0.916108 8.96974 0.392618 8.44625C-0.130872 7.92276 -0.130872 7.07712 0.392618 6.55363L6.55369 0.392559C7.07718 -0.130931 7.92282 -0.130931 8.44631 0.392559L14.6074 6.55363C15.1309 7.07712 15.1309 7.92276 14.6074 8.44625C14.0839 8.95632 13.2248 8.96974 12.7013 8.44625Z" fill="#888888" />
            </svg>
          </div>
        </form>
        <?php
        $clearOn = null;
        foreach ($states as $key => $value) {
          foreach ($positionCat as $cat) {
            if ($value == $searchKey || $cat == ucwords(strtolower($searchKey))) {
              $clearOn = "display:block";
              break;
            }
          }
        }
        ?>
        <div class="clear-all-selection" style="<?php echo $clearOn; ?>">Clear All</div>
      </div>
    </div>
  </div>
  <!--End of Filter section -->
  <!-- Jobs Listing section -->
  <div class="careers-job-list-container">
    <!-- Job records lisiting from DB-->
    <div class="careers-job-list">
      <?php
      if (count($table_data) > 0) {
        foreach ($table_data as $result) {
          $postDescription = $result->Description;
          $postDescription = str_replace(array("â€™", "â€˜"), "'", $postDescription);
          $postDescription = str_replace(array("â€”", "â€“"), "-", $postDescription);
          $postDescription = str_replace(array("&nbsp;", "<br>", "<p>", "</p>", "<strong>", "</strong>"), " ", $postDescription);
      ?>
          <div class="careers-job-list-data">
            <div class="careers-job-post">
              <h2 class="careers-job-post-heading"><a href="/careers/job-listing/career-post/?id= <?php echo $result->Id; ?>"><?php echo $result->Position_title; ?></a></h2>
              <div class="careers-job-post-address">
                <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 12C10.9 12 10 11.1 10 10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 11.1 13.1 12 12 12ZM18 10.2C18 6.57 15.35 4 12 4C8.65 4 6 6.57 6 10.2C6 12.54 7.95 15.64 12 19.34C16.05 15.64 18 12.54 18 10.2ZM12 2C16.2 2 20 5.22 20 10.2C20 13.52 17.33 17.45 12 22C6.67 17.45 4 13.52 4 10.2C4 5.22 7.8 2 12 2Z" fill="black" />
                </svg>
                <p><?php echo $result->City . ", " . $result->Country_sub_name; ?></p>
              </div>
              <div class="careers-job-post-description">
                <?php echo substr($postDescription, 0, 400) . '...'; ?>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <!-- Load More Section -->
        <div class="careers-loadmore-section" style="display:none">
          <a id="loadMore" class="careers-loadmore-button"><span>Load More</span></a>
        </div>
      <?php
      } else {
        echo "<div class='not-found-text-loadmore'>" . "No Jobs Found" . "</div>";
      }
      ?>
    </div>
  </div>
  <!--End of Jobs Listing section -->
</div>
<!--End of Filter and List section -->
</div>
<?php get_footer(); ?>