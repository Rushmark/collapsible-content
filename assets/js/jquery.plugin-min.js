;(function($, window, document, undefined){
	'use strict';
	
	var $qaQuestions, $qaAnswers, $qaIcons, 
		$teaserMessages, $teaserHiddenContents, $teaserIcons;
	
	var init = function(){
		$qaQestions = $('.qa--question');
		$qaAnswers = $qaQuestions.next();
		$qaIcons = $qaQuestions.find('.qa--icon');
		$qaQuestions.on('click', {contentType:'qa'}, clickHandler);
		
		$teaserMessages = $('.teaser--visible-message');
		$teaserHiddenContents = $teaserMessages.next();
		$teaserIcons = $teaserMessages.find('.teaser--icon');
		$teaserMessages.on('click', {contentType:'teaser'}, cilckHandler);
	};
	
	var clickHandler = function( event ){
		console.log( event );
	};
	
	function changeIcon(){
		
	}
	
	function getIndex(){
		
	}
	
	function getHiddenContent(){
		
	}
	
	function getIcon(){
		
	}
	
	function getIconClasses(){
		
	}
	
	$(document).ready(function(){
		init();
	});
})(jQuery, window, document);