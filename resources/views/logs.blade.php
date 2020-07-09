<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Logs</title>
  </head>
  <body>
	<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Query</th>
      <th scope="col">Extra</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($logs as $log)
    <tr>
      <th scope="row">{{ ++$loop->index }}</th>
      <td width="40%">
      	<p><strong>Запрос</strong>: {{$log->message['query']}}</p>
      	<hr>
      	<p>
      		<strong>Кеэшированный</strong>: 
      		@if($log->message['cached'])
      		<span class="badge badge-success">Да</span>
      		@else
      		<span class="badge badge-warning">Нет</span>
      		@endif
      	</p>
      	<hr>
      	<div class="accordion" id="accordionExample{{ $log->id }}">
      	<p>
      		<a href="#" data-toggle="collapse" data-target="#collapseOne{{ $log->id }}" aria-expanded="true" aria-controls="collapseOne">
	  <strong>Результаты</strong>
	</a></p>
	<div id="collapseOne{{ $log->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample{{ $log->id }}">
      	@foreach($log->message['results'] as $result)
      		#{{ ++$loop->index }}
			<li><strong>Название</strong>: {{$result["name"]}}</li>
			<li><strong>Описание</strong>: {{$result["description"]}}</li>
			<li><strong>Координаты</strong>: {{$result["coordinates"]}}</li>
			@if(!$loop->last)
			<hr>
			@endif
      	@endforeach
      </div>
  </div>
      </td>
      <td>

      	@foreach($log->extra as $key => $value)
			<li><strong>{{ucfirst($key)}}</strong>: {{$value}}</li>
      	@endforeach
      </td>
      <td width="15%">{{$log->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
