<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>URL Shortener</title>
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <!-- custom css -->
        <link href="{{ url('/css/style.css')}}" rel="stylesheet" /> 
    </head>
    <body>
        <div class="px-4 py-5 my-5 ">
            <h1 class="display-5 fw-bold text-center mb-5">URL Shortener</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Make youre url short to make it neat and clean!</p>
                <div class="d-grid" >
                    <form class="navbar-form navbar-left needs-validation" novalidate id="form-url-shortener" >
                        {{csrf_field()}}
                        <div class='input-group has-validation'>
                            <input type="text" title="URL" required='required' id="url" class="form-control col-lg-8 text-info" placeholder='https://example.com' name='url'>
                            <div class="invalid-feedback text-left" id='url-error-message'>
                                <p class='display-5'>Please enter a URL</p>
                            </div>
                        </div>
                        <div class='d-flex flex-row-reverse'>
                            <button class='btn btn-lg btn-outline-success mt-3 pt-3 pb-3' type='submit' >Convert</button>	
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 mx-auto">
                <div class='success-area mb-4 d-none'>
                    <h3 class='text-success'>Shorten URL</h3>                  
                    <input readonly class='form-control text-success display-3' id='text' />
                </div>
            </div>
			@if (! empty($allData))
				<div class="col-lg-6 mx-auto recent-conversions">
					<p class="lead mt-5 text-success">Youre recent conversions</p>
					<ul class="list-group list-group-flush">
						@foreach ($allData as $i => $value) 
							@php
								$fullUrl = url()->current() . '/' . $value['short_url'];
							@endphp
							<li class="list-group-item text-success"><a target="_blank" href="{{ $fullUrl }}"> {{ $fullUrl }}</a></li>
						@endforeach
					</ul>
				</div>
			@endif
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="{{ url('/js/home.js')}}" /></script>
    </body>
</html>
