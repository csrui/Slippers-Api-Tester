var $xml = null;

$(document).ready(function() {
	
	$('#select-api').attr('value', '');
  
	$('#select-api').change(function() {
		
		if ($(this).attr('value').length == 0) return;
		
		$.get('scripts/' + $(this).attr('value'), function(data) {
			
			$xml = $(data);			
			setupResources();
			
		}, 'xml');
		
	});

  $('form').submit(function(e) {

	e.preventDefault();

	$('#response_wrapper').empty();

	$.get('request.php', $(this).serialize(), function(response) {

		$('#response_wrapper').empty().append(response);

		$('html, body').animate({
        	scrollTop: $("#response").offset().top
        }, 2000);
		
	});

  });
});


function setupResources() {
	
	$("#url").val($xml.find('script').attr('url'));
	
	$('#select-resources').html('<option></option>');
	$('#select-actions').html('<option></option>');
	
	$('#select-resources').change(setupActions);
	
	$xml.find('script').find('resource').each(function() {

		var resource = $(this).attr('name');
	
		$('#select-resources').append('<option value="'+resource+'">'+resource+'</option>');
		
	});
	
}

function setupActions(e) {
	
	$('#select-actions').html('<option></option>');
	
	$('#select-actions').change(setupParams);

	$xml.find('script').find('resource[name='+e.target.value+']').find('action').each(function() {
		
		var action = $(this).attr('name');
		
		$('#select-actions').append('<option value="'+action+'">'+action+'</option>');
		
	});
	
}

function setupParams(e) {
	
	$('#fieldset-params').html('');
	
	var default_method = 'get';
	var method = $xml.find('script').find('resource[name='+$('#select-resources').attr('value')+']').find('action[name='+e.target.value+']').attr('method');

	if (typeof method == 'undefined') {
		method = default_method;
	}
	$('#select-type').attr('value', method);
	
	$xml.find('script').find('resource[name='+$('#select-resources').attr('value')+']').find('action[name='+e.target.value+']').find('param').each(function() {

		var required = ($(this).attr('required') == 'true') ? 'required' : ''; 
		var type = 'text';
		var param = $(this).text();

		$('#fieldset-params').append('<div class="clearfix '+required+'"><label>'+param+'</label><div class="input"><input type="'+type+'" name="params['+param+']" /></div></div>');
		
	});
	
}

