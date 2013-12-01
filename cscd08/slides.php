<?php 
/*
 * 2012 Mar 11
 * CSCD08 - SyncGallery+
 *
 * Make the slide module as a single file so that we can include this file
 * directly when we need it
 *
 * @author Kobe Sun
 *
 */
?>


<style type="text/css">
#slideshow-holder {
	width: 600px;
	height: 333px;
	background: url(images/slides-spinner.gif) center center no-repeat #fff;
	position: relative;
	border: none;
	margin-bottom: 20px;
} 

#progress {
	color: #999;
}
</style>

<script type="text/javascript">
window.addEvent('domready', function() {
	/* preloading */
	var imagesDir = 'screenshot/';
	var images = new Array();
	for (var i = 1; i < 5; i ++) {
		images[i - 1] = i + '.png';
	}
	var holder = $('slideshow-holder');
	images.each(function(img, i) {
		images[i] = imagesDir + '' + img;
	}); // add dir to images
	var progressTemplate = 'Loading image {x} of ' + images.length;
	var updateProgress = function(num) {
		progress.set('text', progressTemplate.replace('{x}', num));
	};
	var progress = $('progress');
	updateProgress('0');
	var loader = new Asset.images(images, {
		onProgress : function(c, index) {
			updateProgress(index + 1);
		},
		onComplete : function() {
			var slides = [];
			/* put images into page */
			images.each(function(im) {
				slides.push(new Element('img', {
					src : im,
					width : 600,
					height : 333,
					styles : {
						opacity : 0,
						top : 0,
						left : 0,
						position : 'absolute',
						'z-index' : 10
					}
				}).inject(holder));
				holder.setStyle('background',
						'url(images/logo.png) center 30px no-repeat');
			});
			var showInterval = 5000;
			var index = 0;
			progress.set('text', 'Images loaded.  SyncGallery+ Screenshots.');
			(function() {
				slides[index].tween('opacity', 1);
			}).delay(1000);
			var start = function() {
				(function() {
					holder.setStyle('background', '');
					slides[index].fade(0);
					++index;
					index = (slides[index] ? index : 0);
					slides[index].fade(1);
				}).periodical(showInterval);
			};

			/* start the show */
			start();
		}
	});
});

</script>

<div id="slideshow-holder">
	<div id="progress"></div>
</div>
