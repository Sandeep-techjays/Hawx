<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
</div> <!-- ast-container -->
</div><!-- #content -->
<?php
astra_content_after();

// Footer Shortcode 
global $post;
$posttye = $post->post_type;
// if( $posttye != "locations"){
// 	echo do_shortcode('[elementor-template id="6746"]');
// }
// Ends
astra_footer_before();

astra_footer();

astra_footer_after();
?>
</div><!-- #page -->
<?php
astra_body_bottom();
wp_footer();
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61f62eb07448696d"></script>
<script type="text/javascript" src=" https://calldrip.colynk.com/dynamic/dynamic.js"></script>
<script type="text/javascript" src='https://crm.zoho.com/crm/javascript/zcga.js'> </script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
</body>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/owl.carousel.js"></script>
<?php if (isset($_GET['gclid']) && $_GET['gclid'] != '') {  ?>
	<script>
		var gclid = '<?php echo $_GET['gclid'] ?>';
		jQuery('.contactFormMain #zc_gad').val(gclid);
	</script>
<?php } else { ?>
	<script>
		jQuery('#zc_gad').val('');
	</script>
<?php }
if (is_page(6817)) { ?>
	<script>
		$ = jQuery.noConflict(true);
		$(window).scroll(function(e) {
			var $el = $('.mobileHeaderContact');
			var isPositionFixed = ($el.css('position') == 'fixed');
			if ($(this).scrollTop() > 200 && !isPositionFixed) {
				$el.css({
					'position': 'fixed',
					'top': '0px',
					'width': '100%'
				});
			}
			if ($(this).scrollTop() < 200 && isPositionFixed) {
				$el.css({
					'position': 'static',
					'top': '0px'
				});
			}
		});
	</script>
<?php } ?>
<script>
	jQuery(document).ready(function($) {
		$(".leftSideSubmenu .subContainer i").click(function() {
			if ($(this).parent().parent().find('.subMenuLeft:first').hasClass('active')) {
				$(this).parent().parent().find('.subMenuLeft:first').removeClass('active');
				$(this).parent().parent().find('.subMenuLeft:first').hide();
			} else {
				$(this).parent().parent().find('.subMenuLeft:first').addClass('active');
				$(this).parent().parent().find('.subMenuLeft:first').show();
			}
		});
		// var owl = $('.owl-carousel').owlCarousel({
		// 	loop:true,
		// 	margin:10,
		// 	nav:false,
		// 	//navText: ["<i class='fa fa-angle-left customPrevBtn' style='font-size: 50px;color: green;'></i>","<i class='fa fa-angle-right customNextBtn' style='font-size: 50px;color: green;'></i>"],
		// 	dots: true,
		// 	responsive:{
		// 		0:{
		// 			items:1
		// 		},
		// 		600:{
		// 			items:3
		// 		},
		// 		1000:{
		// 			items:5
		// 		}
		// 	},
		// 	onInitialized: counter, //When the plugin has initialized.
		// 	onTranslated: counter
		// });
		// // Go to the next item
		// $('.customNextBtn').click(function() {
		// 	owl.trigger('next.owl.carousel');
		// })
		// // Go to the previous item
		// $('.customPrevBtn').click(function() {
		// 	owl.trigger('prev.owl.carousel');
		// });
		// Form Keyup
		$('.contactFormMain input, .contactFormMain input').each(function() {
			if ($(this).val() != '') {
				$(this).parent().addClass('active');
			} else {
				$(this).parent().removeClass('active');
			}
		});
		$('.contactFormMain input, .contactFormMain input').on('keyup', function() {
			if ($(this).val() != '') {
				$(this).parent().addClass('active');
			} else {
				$(this).parent().removeClass('active');
			}
		});
		$(window).scroll(function(e) {
			var $el = $('.mobileHeaderContact');
			var isPositionFixed = ($el.css('position') == 'fixed');
			if ($(this).scrollTop() > 200 && !isPositionFixed) {
				$el.css({
					'position': 'fixed',
					'top': '0px',
					'width': '100%'
				});
			}
			if ($(this).scrollTop() < 200 && isPositionFixed) {
				$el.css({
					'position': 'static',
					'top': '0px'
				});
			}
		});
		$('.locationFinderButton').on('click', function(e) {
			e.preventDefault();
			var inputValue = $('.inputLocFinder').val();
			if (inputValue != '' && inputValue.match(/^ *$/) == null) {
				console.log(e.which);
				console.log('testing');
				window.location.replace('/results?q=' + inputValue);
			} else {
				$('.error').html('<p>Please enter City or State or Zip code</p>').css({
					'color': 'red',
					'padding-top': '10px',
					'margin-left': '-12%',
					'font-size': '14px'
				});
				return false;
			}
		});

		$(".inputSearch").keypress(function(e) {
			var keyCode = e.keyCode || e.which;
			var inputValue1 = $('.searchLocation').val();
			$(".error").html("");
			var regex = /^[A-Za-z0-9.\-()' ]+$/;
			var isValid = regex.test(String.fromCharCode(keyCode));
			if (!isValid) {
				$(".error").html("<p>Only Alphabets and Numbers allowed.</p>").css({
					'color': 'red',
					'padding-top': '10px',
					'margin-left': '-12%',
					'font-size': '14px'
				});
			}
			return isValid;
		});
		$('.inputSearch').keydown(function(e) {
			var inputValue = $('.inputLocFinder').val();
			if (e.which === 13) {
				e.preventDefault();
				window.location.replace('/results?q=' + inputValue);
			}
		});
		$('.reset_search').on('click', function() {
			$('#searchForm')[0].reset();
		});
		$('.searchLocation').keydown(function(e) {
			if (e.which === 13) {
				e.preventDefault();
				var inputValue1 = $('.searchLocation').val();
				if (inputValue1 != '' && inputValue1.match(/^ *$/) == null) {
					window.location.replace('/results?q=' + inputValue1);
				} else {
					$('.error').html('<p>Please enter City or State or Zip code</p>').css({
						'color': 'red',
						'padding-top': '2%',
						'font-size': '14px'
					});
					return false;
				}
			}
		});

		$('.contactSubmitBtn').on('click', function() {
			uet_report_conversion();
		});
		//Location Page - Single Service Icon Default 
		$('.services-single-col').find('.elementor-icon').css('border', '3px solid #F3F3F3');
		$('.services-single-col').find('.elementor-icon svg').css('fill', '#828282');
		$('.services-single-col').find('h2.elementor-heading-title').css('color', '#161C1C');
		//Location Page - Single Service Icon Hovering
		$('.services-single-col').hover(function() {
			$(this).find('.elementor-icon').css('border', '3px solid #FFB850');
			$(this).find('.elementor-icon svg').css('fill', '#333333');
			$(this).find('h2.elementor-heading-title').css('color', '#FFB850');
			$(this).find('h2.elementor-heading-title').css('font-weight', '600');
		}, function() {
			$(this).find('.elementor-icon').css('border', '3px solid #F3F3F3');
			$(this).find('.elementor-icon svg').css('fill', '#828282');
			$(this).find('h2.elementor-heading-title').css('color', '#161C1C');
			$(this).find('h2.elementor-heading-title').css('font-weight', '400');
		});
	});
	//display no of items in the carousel
	function counter(event) {
		var element = event.target;
		var items = event.item.count;
		var item = event.item.index + 1;
		if (item > items) {
			item = item - items
		}
	}
	//Testimonal Section
	jQuery(document).ready(function($) {
		$('.testiScroll').click(function() {
			var id = $(this).attr('id');
			$('.testiScroll').removeClass("active");
			$('.testiRightSide').removeClass("active");
			$('#' + id).addClass("active");
			$('.testiRightSide.' + id).addClass("active");
		});
	});
	jQuery(document).ready(function($) {
		$(".LocationsFooter").hide();
		$('.showHideBtn').click(function() {
			if (window.matchMedia("(max-width: 767px)").matches) {
				if ($('.LocationsFooterMbl').hasClass('hide')) {
					$('.LocationsFooterMbl').show();
					$('.LocationsFooterMbl').addClass('show');
					$('.LocationsFooterMbl').removeClass('hide');
					$('#locShowHide i').removeClass('fa-angle-up');
					$('#locShowHide i').addClass('fa-angle-down');
					$("html, body").animate({
						scrollTop: $(document).height()
					}, "slow");
				} else {
					$('.LocationsFooterMbl').hide();
					$('.LocationsFooterMbl').removeClass('show');
					$('.LocationsFooterMbl').addClass('hide');
					$('#locShowHide i').addClass('fa-angle-up');
					$('#locShowHide i').removeClass('fa-angle-down');
				}
			} else {
				if ($('.LocationsFooter').hasClass('hide')) {
					$('.LocationsFooter').show();
					$('.LocationsFooter').addClass('show');
					$('.LocationsFooter').removeClass('hide');
					$('#locShowHide i').removeClass('fa-angle-up');
					$('#locShowHide i').addClass('fa-angle-down');
					$("html, body").animate({
						scrollTop: $(document).height()
					}, "slow");
				} else {
					$('.LocationsFooter').hide();
					$('.LocationsFooter').removeClass('show');
					$('.LocationsFooter').addClass('hide');
					$('#locShowHide i').addClass('fa-angle-up');
					$('#locShowHide i').removeClass('fa-angle-down');
				}
			}
		});

		var owl_new = $('.treatmentList').owlCarousel({
			margin: 10,
			nav: true,
			dots: false,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			items: 1,
			autoWidth: true,
			autoHeight: true,
			loop: true
		});
		// var owl_new = $('.testimonial-section').owlCarousel({
		// 	margin: 10,
		// 	nav: true,
		// 	dots: false,
		// 	navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
		// 	items: 1,
		// 	autoWidth: true,
		// 	autoHeight: true,
		// 	loop: true
		// });
	});
</script>
<script src="https://lmk.pestroutes.com/resources/scripts/embeddedComponent/build/afn.js"></script>
<script type="text/javascript" src="https://app.termly.io/embed.min.js" data-auto-block="on" data-website-uuid="236e61db-ec03-4ecb-bf56-f0e78a65b3c0"></script>
<!--
<script src="https://app.five9.com/consoles/SocialWidget/five9-social-widget.min.js"></script>
<script>
var options = {
	"rootUrl": "https://app.five9.com/consoles/",
	"type": "chat",
	"title": "Hawx Pest Control",
	"tenant": "Hawx Pest Control",
	"profiles": "Select,Customer Success,Billing,Spanish",
	"showProfiles": true,
	"autostart": true,
	"theme": "high-contrast.css",bhuh
	"logo": "https://hawxpestcontrol.com/wp-content/uploads/2022/03/hawx-logo-02-03-03.png",
	"surveyOptions": {
		"showComment": false,
		"requireComment": false
	},
	"fields": {
		"name": {
			"value": "",
			"show": true,
			"label": "Name"
		},
		"email": {
			"value": "",
			"show": true,
			"label": "Email"
		},
		"Phone": {
			"value": "",
			"show": true,
			"label": "Phone Number",
			"required": false
		}
	},
	"playSoundOnMessage": true,
	"allowCustomerToControlSoundPlay": false,
	"showEmailButton": false,
	"hideDuringAfterHours": true,
	"useBusinessHours": true,
	"showPrintButton": false,
	"allowUsabilityMenu": false,
	"enableCallback": false,
	"callbackList": "",
	"allowRequestLiveAgent": false
};
Five9SocialWidget.addWidget(options);
</script>-->
<script>
	// Career Page Filter - select state
	jQuery(document).ready(function($) {
		//filter delay
		setTimeout(function() {
			var $loading = $(".loading");
			var $loadContainer = $(".loading-container");
			// Remove the animation from the loading element
			$loading.css("animation", "none");
			$loadContainer.css("display", "none");
			$(".careers-search-container,.job-filter-list-container, .careers-job-list-container ").show();
		}, 2000);
		$(".js-select1").select2({
				closeOnSelect: false,
				dropdownParent: $('.careers-filter-state-search'),
				placeholder: "State",
				disabled: true
			})
			.on("change.select2", function(e) {
				$(".select2-results").on("click", function(e) {
					$('.js-select1').select2('focus');
				});
				var selected_state = $(".js-select1");
				var select_val_state = selected_state.val();
				var selected_cat = $(".js-select2");
				var select_val_cat = selected_cat.val();
				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
				$.ajax({
					type: "post",
					url: ajaxurl,
					data: {
						action: "mobile_filter",
						stateVal: select_val_state,
						catVal: select_val_cat
					},
					success: function(response) {
						var obj = jQuery.parseJSON(response);
						if (obj.status == "success") {
							$('.careers-job-list').html(obj.message);
							$(".careers-job-list-data").slice(0, 4).addClass("show-more-job").show();
							if ($(".careers-job-list-data").length <= 4) {
								$(".careers-loadmore-section").hide();
							} else {
								$(".careers-loadmore-section").show();
							}
							$("#loadMore").on("click", function(e) {
								e.preventDefault();
								$(".careers-job-list-data:hidden").slice(0, 4).addClass("show-more-job").slideDown();
								var listLen = $(".careers-job-list-data:hidden").length;
								if (listLen == 0) {
									$(".careers-loadmore-section").hide();
								}
							});
						} else {
							location.reload(true);
						}
					}
				});
				if (select_val_state != '') {
					$(".clear-all-selection").show();
					var val = [];
					$(".js-select1 option:selected").each(function() {
						val.push(this.text);
					});
					$(".careers-filter-state-search .select2-selection__rendered").text(val.join(', '));
				} else {
					if (select_val_cat == '') {
						$(".clear-all-selection").hide();
					}
				}
			});
		// clear all filter
		$(".clear-all-selection").on('click', function() {
			$(".js-select1,.js-select2").val('').trigger('change');
			$(".clear-all-selection").hide();
		});
		//drop-down toggler-state
		$('.careers-filter-state-search .select2').on('click', function() {
			if ($('.careers-filter-state-search .opener').hasClass('active')) {
				$(".careers-filter-state-search .opener").removeClass('active').addClass('inactive');
				$('.form-filter .careers-filter-state-search .closer').removeClass('inactive').addClass('active');
				$('.js-select1').select2('open');
			} else {
				$(".careers-filter-state-search .opener").removeClass('inactive').addClass('active');
				$('.form-filter .careers-filter-state-search .closer').removeClass('active').addClass('inactive');
				$('.js-select1').select2('close');
			}
			$('.form-filter .careers-filter-cat-search .closer-c').removeClass('active').addClass('inactive');
			$('.form-filter .careers-filter-cat-search .opener-c').removeClass('inactive').addClass('active');
		});
		// Career Page Filter - select category
		$(".js-select2").select2({
				closeOnSelect: false,
				dropdownParent: $('.careers-filter-cat-search'),
				placeholder: "Job Category",
				disabled: true
			})
			.on("change.select2", function(e) {
				$(".select2-results").on("click", function(e) {
					$('.js-select2').select2('focus');
				});
				var selected_state = $(".js-select1");
				var select_val_state = selected_state.val();
				var selected_cat = $(".js-select2");
				var select_val_cat = selected_cat.val();
				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
				$.ajax({
					type: "post",
					url: ajaxurl,
					data: {
						action: "mobile_filter",
						stateVal: select_val_state,
						catVal: select_val_cat
					},
					success: function(response) {
						var obj = jQuery.parseJSON(response);
						if (obj.status == "success") {
							$('.careers-job-list').html(obj.message);
							$(".careers-job-list-data").slice(0, 4).addClass("show-more-job").show();
							if ($(".careers-job-list-data").length <= 4) {
								$(".careers-loadmore-section").hide();
							} else {
								// setTimeout(function() {
								$(".careers-loadmore-section").show();
								// }, 1000);
							}
							$("#loadMore").on("click", function(e) {
								e.preventDefault();
								$(".careers-job-list-data:hidden").slice(0, 4).addClass("show-more-job").slideDown();
								var listLen = $(".careers-job-list-data:hidden").length;
								if (listLen == 0) {
									$(".careers-loadmore-section").hide();
								}
							});
						} else {
							location.reload(true);
						}
					}
				});
				if (select_val_cat != '') {
					$(".clear-all-selection").show();
					var val = [];
					$(".js-select2 option:selected").each(function() {
						val.push(this.text);
					});
					$(".careers-filter-cat-search .select2-selection__rendered").text(val.join(', '));
				} else {
					if (select_val_state == '') {
						$(".clear-all-selection").hide();
					}
				}
			});
		//drop-down toggler-category
		$(".careers-filter-cat-search .select2").on('click', function() {
			if ($(".careers-filter-cat-search .opener-c").hasClass('active')) {
				$('.js-select2').select2('open');
				$(".careers-filter-cat-search .opener-c").removeClass('active').addClass('inactive');
				$('.careers-filter-cat-search .closer-c').removeClass('inactive').addClass('active');
			} else {
				$(".careers-filter-cat-search .opener-c").removeClass('inactive').addClass('active');
				$('.form-filter .careers-filter-cat-search .closer-c').removeClass('active').addClass('inactive');
				$('.js-select2').select2('close');
			}
			$('.form-filter .careers-filter-state-search .closer').removeClass('active').addClass('inactive');
			$('.form-filter .careers-filter-state-search .opener').removeClass('inactive').addClass('active');
		});
		// load more section-careers_page
		$(".careers-job-list-data").slice(0, 4).addClass("show-more-job").show();
		if ($(".careers-job-list-data").length <= 4) {
			$(".careers-loadmore-section").hide();
		} else {
			$(".careers-loadmore-section").show();
		}
		$("#loadMore").on("click", function(e) {
			e.preventDefault();
			$(".careers-job-list-data:hidden").slice(0, 4).addClass("show-more-job").slideDown();
			var listLen = $(".careers-job-list-data:hidden").length;
			if (listLen == 0) {
				$(".careers-loadmore-section").hide();
			}
		});
		//search-careers-page
		$('#txtName').keydown(function(e) {
			var textInp = $("#txtName").val();
			if (textInp.length == 0 && e.which === 32) {
				e.preventDefault();
			} else {
				var key = e.keyCode;
				if (!((key == 8) || (key == 32) || (key == 13) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90) || (e.shiftKey && e.keyCode === 55))) {
					e.preventDefault();
				} else {
					$(".errorbtn").text("");
				}
			}
		});
		$("#btnCheck").click(function(e) {
			e.preventDefault();
			var textInpArr = $("#txtName").val().trim().split(" ");
			var cleanArr = textInpArr.filter(removeSpace => {
				return removeSpace != "";
			});
			var textInp = cleanArr.join(" ");
			var textInput = encodeURIComponent(textInp);
			if (textInput == "") {
				$(".errorbtn").text("Please enter Role or Location").css('color', 'red');
				return false;
			} else {
				var url = "/careers/job-listing/?search-loc-role=" + textInput;
				$(location).prop('href', url);
			}
		});
		// outer click action defaultifier
		$("html").on('click', function(e) {
			if ($(".select2").hasClass('select2-container--open') == false) {
				$('.form-filter .careers-filter-state-search .closer').removeClass('active').addClass('inactive');
				$('.form-filter .careers-filter-state-search .opener').removeClass('inactive').addClass('active');
				$('.form-filter .careers-filter-cat-search .closer-c').removeClass('active').addClass('inactive');
				$('.form-filter .careers-filter-cat-search .opener-c').removeClass('inactive').addClass('active');
			}
		});
	});
</script>

</html>