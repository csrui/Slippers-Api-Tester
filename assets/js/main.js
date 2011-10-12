var $xml = null;

$(document).ready(function() {
	
	$('#select-api').attr('value', '');
	$('#url').attr('value', '');

	$('#select-api').change(function() {
		
		var api_filename = $(this).attr('value');
		
		if (api_filename.length == 0) return;
		
		$('#nav-item-docs').find('a').attr('href', 'docs.php?api='  + api_filename);
		
		$.get('scripts/' + api_filename, function(data) {
			
			$xml = $(data);			
			setupResources();
			
		}, 'xml');
		
	});

  $('form').submit(function(e) {

	e.preventDefault();
	
	var is_dirty = false;
	
	$('#fieldset-params').find('.required').find('input[type=text]').each(function() {
				
		if ($(this).val().length == 0) {
			$(this).parent().parent().addClass('error');
			is_dirty = true;
		} else {
			$(this).parent().parent().removeClass('error');
		}
		
	});

	$('#response_wrapper').empty();
	
	if (is_dirty === true) return false;

	$.get('request.php', $("#form-request").serialize(), function(response) {

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
		var url = ($(this).attr('url') == 'true') ? true : false; 
		var type = 'text';
		var param = $(this).text();

		$('#fieldset-params').append('<div class="clearfix '+required+'"><label>'+param+'</label><div class="input"><input type="'+type+'" name="params['+param+'][value]" /><input type="hidden" name="params['+param+'][url]" value="'+url+'" /></div></div>');
		
	});
	
}

