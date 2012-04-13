// usage: log('inside coolFunc', this, arguments);
window.log = function f(){ log.history = log.history || []; log.history.push(arguments); if(this.console) { var args = arguments, newarr; args.callee = args.callee.caller; newarr = [].slice.call(args); if (typeof console.log === 'object') log.apply.call(console.log, console, newarr); else console.log.apply(console, newarr);}};

// make it safe to use console.log always
(function(a){function b(){}for(var c="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),d;!!(d=c.pop());){a[d]=a[d]||b;}})
(function(){try{console.log();return window.console;}catch(a){return (window.console={});}}());


$(function () { 

	// Menu of links
	var menuLinks = $('#menuPermissions');



	function toggleMenu(linkHeader, time){
		linkHeader.find('i').toggleClass('icon-plus');
		linkHeader.find('i').toggleClass('icon-minus');
		if(time == undefined || time == 0)
			linkHeader.nextUntil('.nav-header', '.nav-child').show();	
		else
			linkHeader.nextUntil('.nav-header', '.nav-child').toggle(time);
	} 	

	

	menuLinks.find('li.nav-header')
		.css('cursor', 'pointer')
		.click(function(e){
			toggleMenu($(this), 400);
		});
	
	toggleMenu(
				menuLinks.find('li.nav-child.active')
					.prevAll('.nav-header')
					.eq(0)
				, 0);
	


	// show a alert box for mensages	
	$('.alertNoty').each(function(e){
		  noty({
		  	timeout : 5000,
		  	closeButton : true,
		  	theme : 'noty_theme_twitter',
		  	text: $(this).text(),
		  	type: $(this).data('alert-type')
		  }); 
	});
 


	$('[data-toggle="modal"]').each(function(e){
		
		if($(this).data('confirm-id') != undefined){

			var idRemove = $(this).data('confirm-id');

			$(this).click(function(){			 

				$('a.confirm-link').each(function(){					
					$(this).attr('href', $(this).data('confirm-link') + '/' + idRemove);
				});				
			});
		}
	}); 
  
});






