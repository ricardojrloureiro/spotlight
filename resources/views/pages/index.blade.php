@extends('app')


@section('content')

    <div class="section" id="body_section">
        @include('partials.header')

		<div class="row">
			<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-center">
                <div id="player" class="video-player"> </div>


			</div> <!-- /col -->
		</div> <!-- /row -->

		<div class="footer">
            <div class="container">
                <p class="text-muted">  lolspotlight™ © </p>
            </div>
		</div>
    </div>


@stop


