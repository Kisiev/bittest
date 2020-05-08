<div>User: <?=$user['login']?></div>
<div>balance: <?=$user['balance']?></div>
<input type="text" value="10" placeholder="вывод денег" id="amount">
<button onclick="takeMoney(event)">вывод</button>
<a href="/logout/">выход</a>
<div style="color: red" id="error"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	function takeMoney(event)
	{
		event.preventDefault();
		let amount = $('#amount').val();
		$.ajax({
			url: '/takeMoney/',
			method: 'post',
			type: 'post',
			dataType: 'json',
			data: {amount: amount},
			success: function(data)
			{
				if (!data.success)
					return $('#error').html(data.msg);

				window.location.reload();
			}
		});
	}
</script>