<form id="authForm" onsubmit="auth(event)">
	<input type="text" placeholder="login" name="login">
	<input type="text" placeholder="password" name="password">
	<input type="submit">
	<div id="error" style="color: red;"></div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	function auth(event)
	{
		event.preventDefault();
		let form = $('#authForm').serialize();
		$.ajax({
			url: '/auth/',
			method: 'post',
			type: 'post',
			dataType: 'json',
			data: form,
			success: function(data)
			{
				if (!data.success)
					return $('#error').html(data.msg);

				window.location.href = '/lk/';
			}
		});
	}
</script>