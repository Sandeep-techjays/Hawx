<?php
/* Template Name: Site Search */
get_header(); ?>

<div class="siteSearchContainer">
    <h1 class="siteSearchTitle">HOW CAN WE HELP YOU?</h1>
    <div class="siteSearchForm">
        <div class="siteSearchFormC">
            <input type="text" name="siteSearch" id="siteSearch" value="" placeholder="Search by keyword">
            <a href="#" class="siteSearchSt">Search</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($){
        $('.siteSearchSt').on('click', function(e){
            e.preventDefault();
            var search_val = $('#siteSearch').val();       
            window.location.replace("/?s="+search_val);
        });
    });
</script>