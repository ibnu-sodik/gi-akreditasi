jQuery(function($) {
	$('.easy-pie-chart.percentage').each(function(){
		var $box = $(this).closest('.infobox');
		var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
		var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
		var size = parseInt($(this).data('size')) || 50;
		$(this).easyPieChart({
			barColor: barColor,
			trackColor: trackColor,
			scaleColor: false,
			lineCap: 'butt',
			lineWidth: parseInt(size/10),
			animate: ace.vars['old_ie'] ? false : 1000,
			size: size
		});
	})

	$('.sparkline').each(function(){
		var $box = $(this).closest('.infobox');
		var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
		$(this).sparkline('html',
		{
			tagValuesAttribute:'data-values',
			type: 'bar',
			barColor: barColor ,
			chartRangeMin:$(this).data('min') || 0
		});
	});

	var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
	
	
	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
	});

				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});




				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}

				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}

				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				

				// var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				// $.plot("#sales-charts", [
				// 	{ label: "Domains", data: d1 },
				// 	{ label: "Hosting", data: d2 },
				// 	{ label: "Services", data: d3 }
				// 	], {
				// 		hoverable: true,
				// 		shadowSize: 0,
				// 		series: {
				// 			lines: { show: true },
				// 			points: { show: true }
				// 		},
				// 		xaxis: {
				// 			tickLength: 0
				// 		},
				// 		yaxis: {
				// 			ticks: 10,
				// 			min: -2,
				// 			max: 2,
				// 			tickDecimals: 3
				// 		},
				// 		grid: {
				// 			backgroundColor: { colors: [ "#fff", "#fff" ] },
				// 			borderWidth: 1,
				// 			borderColor:'#555'
				// 		}
				// 	});


				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}


				$('.dialogs,.comments').ace_scroll({
					size: 300
				});
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
					$('#tasks').on('touchstart', function(e){
						var li = $(e.target).closest('#tasks li');
						if(li.length == 0)return;
						var label = li.find('label.inline').get(0);
						if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
					});
				}

				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
				}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});


				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();

					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});

			});

function kembali()
{
	window.history.back();
}

$('.judul').keyup(function(){
	var title = $(this).val().toLowerCase().replace(/[&\/|\\#^, \]\[+()$~%.'":*?<>{}]/g,'-');
	$('.slug').val(title);
});

$('.tombol-hapus').on('click', function(e) {
	e.preventDefault();
	const href = $(this).attr('href');
	swal({
		title: "Apakah Anda Yakin?",
		text: "Data Ini Akan Saya Hapus!",
		icon: "warning",
		buttons: true,
		dangerMode: true
	}).then((willDelete) => {
		if (willDelete) {
			document.location.href = href;
		}
	});
});

$('.tombol-logout').on('click', function(e) {
	e.preventDefault();
	const href = $(this).attr('href');
	swal({
		title: "Apakah Anda Yakin Ingin Keluar?",
		text: "Jika Iya sesi anda akan berakhir.!",
		icon: "info",
		buttons: true,
		dangerMode: true
	}).then((willLogOut) => {
		if (willLogOut) {
			document.location.href = href;
		}
	});
});