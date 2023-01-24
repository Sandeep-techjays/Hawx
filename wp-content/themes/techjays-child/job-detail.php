<?php
/* Template Name: Job Detail */
get_header();
?>
<style>

    /* Media query for Mobile */

   @media only screen and (max-width: 600px){
    .career-post-content h1{
        font-size: 26px !important;
    }
    .career-post-location{
        font-size: 13px !important;
        padding-bottom : 5px !important;
    }
    .career-post-location svg{
        width:20px;
        height: 26px;
    }
    .career-post-location p{
       margin: 2px 0px 8px 8px !important;
    }
    .career-post-desc p{
        font-size: 13px !important;
        margin-top: -5px !important;
    }
    .career-post-content{
        padding: 25px !important;
    }
    #career-post-btn{
        font-size: 14px !important;
        margin-bottom: 10% !important;
        padding: 3% 10% !important;
    }
    .career-post-desc  li::before {
        left: 8% !important;
    }
    .career-post-desc li {
        font-size: 13px !important;
        padding: 0 0 0 20px !important;
        line-height: 30px;
    }
    .career-post-desc ul ul {
       margin: 2% 2% 3% 6% !important;

    }
    .career-post-desc ul ul li:before{
        margin-left: 12% !important;
        margin-top: 1px !important;

    }
    .career-post-desc ul ul p {
       line-height: 15px !important;

    }
  }

/* Media query for Tablets */

  @media only screen and (min-width: 768px) and (max-width: 1114px) {
    .career-post-content{
        padding: 25px !important;
        padding-bottom : 8% !important;
    }
    .career-post-desc li::before {
    left: 25px !important;
    }
    .career-post-desc ul ul li:before{
        margin-left: 9% !important;
        margin-top: -3px !important;
    }
    .career-post-desc ul ul p {
       line-height: 6px !important;

    }
    .career-post-desc li {
      line-height: 30px !important;
    }
    #career-post-btn{
        font-size: 15px !important;
    }
  }
/* 15 screen size */
@media only screen and (min-width: 1200px) and (max-width: 1400px)
{
    .career-post-content{
        padding: 5% 7% 5% 7% !important;
    }
    .career-post-desc li::before {
    left: 7% !important;
    }
    #career-post-btn{
        margin-bottom: 4% !important;
    }

}

/* Style for desktop */
em{
    font-style: inherit;
  }
    .career-post-main{
        background-color: #F5F7F7; 
        height: 100%; 
        width: 100%;
    }
    .career-post-content{
        padding: 5% 14% 5% 14%;
    }
    .career-post-content h1{
        font-family: 'Sora';
        font-style: normal;
        font-weight: 700;
        font-size: 40px;
        color: #637675;
    }
    .career-post-desc p{
        font-family: 'Sora' !important;
        font-style: normal;
        font-weight: 400;
        font-size: 15px;
        line-height: 30px;
        padding-right: 12px;
    }
    .career-post-desc  strong{
     font-weight : 400;
    }
    #career-post-btn{
        background-color: #EAB749 !important;
        color: #FFFFFF;
        border: none;
        padding: 1.4% 5.5%;
        font-family: 'Sora';
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 18px;
        border-radius: 10px !important;
        margin-top: 4%;
    }
    .career-post-location {
        color: #161C1C;
        font-family: 'Sora';
        font-style: normal;
        font-weight: 600;
        font-size: 24px;
        padding-top: 20px;
        padding-bottom: 20px;
        display:flex;
    }
    .career-post-location p{
       margin: -8px 0px 8px 5px;
    }
    
    .career-post-desc ul ul {
       margin: 3% 2% 3% 2%;

    }
    .career-post-desc ul ul p {
       line-height:10px;

    }
    .career-post-desc ul ul li:before{
        margin-left: 4%;
        margin-top: -2px;
    }

    .career-post-desc  li::before {
    background-color: #EAB749;
    border-color: #806265;
    box-shadow: inset 0 0 0 0.167em #ffffff;
    content: '';
    position: absolute;
    margin-top: 8px;
    left: 14%;
    width: 0.944em;
    height: 0.944em;
    border-radius: 50%;
    border-style: solid;
    border-width: 0.056em;
    }

   .career-post-desc li {
    margin-bottom: 1.75em;
    font-size: 15px;
    padding: 0 0 0 30px;
    list-style: none;
    font-family: 'Sora';
    position: initial;
    }
</style>

<?php
   global $wpdb;
   $id=(int)$_GET['id'];
   $get = $wpdb->get_results(" SELECT * FROM ".$wpdb->prefix."career WHERE id=".$id." ");
    foreach( $get as $result ) {
    $position = $result->Position_title;
    $address = $result->City . ", " . $result->Country_sub_name;
    $description = $result->Description;
    $desc = str_replace("\\r\\n",' ',$description);
    $modified_description = str_replace(array("â€™","â€˜"), "'", $desc);
    $mod_description = str_replace(array("â€”","â€“"), "-", $modified_description);
    $apply_url = $result->Apply_url;
    }
?>

<div class="career-post-main">
<div class="career-post-content">
     <h1><?php echo $position;?></h1>
     <!-- <div class="career-post-location"><img src="/wp-content/uploads/2022/11/place.png"></img><php echo $address ?></div> -->
     <div class="career-post-location">
        <svg width="25" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C10.9 12 10 11.1 10 10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 11.1 13.1 12 12 12ZM18 10.2C18 6.57 15.35 4 12 4C8.65 4 6 6.57 6 10.2C6 12.54 7.95 15.64 12 19.34C16.05 15.64 18 12.54 18 10.2ZM12 2C16.2 2 20 5.22 20 10.2C20 13.52 17.33 17.45 12 22C6.67 17.45 4 13.52 4 10.2C4 5.22 7.8 2 12 2Z" fill="black" />
                  </svg><p><?php echo $address ?></p></div>
     <div class="career-post-desc"><p><?php echo $mod_description; ?></p></div>
    <a href="<?php echo $apply_url;?>"> <input id="career-post-btn" class="careers-post-btn" type="submit" value="Apply Now"/></a>
</div>
</div>
<?php get_footer(); ?>

<!-- Script for deleting unwanted br and &nbsp -->
<script>
    var el = document.querySelector('.career-post-desc');
     el.innerHTML = el.innerHTML.replace(/&nbsp;/g,' ');
     el.innerHTML = el.innerHTML.replace(/<br>/g,' ');
</script>
