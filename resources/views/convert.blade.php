<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
</head>

<body>
	<div class="d-flex flex-column justify-content-center align-items-center vw-100 vh-100">
		<form id="form">
			@csrf
			<div class="form-group">
				<label>Из:</label>
				<select name="from" class="form-control" id="from" required>
					@foreach($currencies as $currency)
					<option value="{{ $currency->char_code }}">{{ $currency->char_code }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>В:</label>
				<select name="to" id="to" class="form-control" required>
					@foreach($currencies as $currency)
					<option value="{{ $currency->char_code }}">{{ $currency->char_code }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Значение:</label>
				<input type="text" name="value" id="value" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Дата (необязательно):</label>
				<input type="date" name="date" class="form-control" />
			</div>
			<div class="text-center mt-2">
				<button class="btn btn-primary text-center" type="submit">Конвертировать</button>
			</div>
		</form>
		<div class="mt-2">
			<label>Результат:</label>
			<span id="result"></span>
		</div>
	</div>

	<script>
		const form = document.querySelector('#form');

		form.addEventListener('submit', (event) => {
			event.preventDefault();

			const formData = new FormData(form);
			const formObject = Object.fromEntries(formData);

			const rawDate = formObject.date;
			formObject.date = rawDate.split('-').reverse().join('-');

			if (formObject.date === '') {
				delete formObject.date;
			}

			const query = new URLSearchParams(formObject);

			fetch(`api/convert?${query}`)
				.then((response) => response.json())
				.then((json) => {
					console.log('Успешная конвертация');
					console.log(json);

					const resultContainer = document.querySelector("#result");

					resultContainer.innerHTML = json.result.toFixed(2);
				})
				.catch((error) => console.error(error));
		});
	</script>
</body>

</html>