<script type="text/javascript">

	$(document).ready(function()
	{
			$(".request_ajax_ms1").change(function(){
					var json = { "_token": "{{ csrf_token() }}", "ajax_id" : this.value};
					// You may also use the .post method without the extra error checking and flare of .ajax
					// $.post(url, json, function(data){
					// 	if (data){
					// 		$("#box").html(data.something);
					// 	}
					// });
					$.ajax({
							url: url,
							dataType: 'json',
							type: 'POST',
							data: json,
							success: function(data, textStatus, XMLHttpRequest)
							{
									$(".response_ajax_ms1").html(data.something);
									$("#response_ajax_ms11").fadeOut();
							},
							error: function(XMLHttpRequest, textStatus, errorThrown)
							{
									// Error Message
									$("#response_ajax_ms11").html( XMLHttpRequest.status + 'Error connecting to:' + XMLHttpRequest.statusText);
							}
					});
					// Loading message
					$("#response_ajax_ms11").html('<span style="color:red">loading...</span>');
			});
			// 2 level
			$(".response_ajax_ms1").change(function(){
					var json = { "_token": "{{ csrf_token() }}", "ajax_id" : this.value};

					// You may also use the .post method without the extra error checking and flare of .ajax
					// $.post(url, json, function(data){
					// 	if (data){
					// 		$("#box").html(data.something);
					// 	}
					// });
					$.ajax({
							url: url,
							dataType: 'json',
							type: 'POST',
							data: json,
							success: function(data, textStatus, XMLHttpRequest)
							{
									$(".response_ajax_ms2").html(data.something);
									$("#response_ajax_ms22").fadeOut();
							},
							error: function(XMLHttpRequest, textStatus, errorThrown)
							{
									// Error Message
									$("#response_ajax_ms22").html( XMLHttpRequest.status + 'Error connecting to:' + XMLHttpRequest.statusText);
							}
					});
					// Loading message
					$("#response_ajax_ms22").html('<span style="color:red">loading...</span>');
			});

			//other type
			$("#request_ajax_ms").change(function(){
					var json = { "ajax_id" : this.value};
					//var url = "";
					// You may also use the .post method without the extra error checking and flare of .ajax
					$.post(url, json, function(data){
							if (data){
									$("#response_ajax_ms1").html(data.something);
							}
					});
					// Loading message
					$("#response_ajax_ms1").html('loading...');
			});
	});
	</script>
