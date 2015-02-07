<nav class="navbar navbar-default" id="header">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <label class="navbar-brand"> LoLSpotlight </label>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
     <ul class="nav navbar-nav" id="list_types">
            <li>
                <a>
                    {!! Form::open(['url' =>'/']) !!}
                      {!! Form::submit('Recent Videos') !!}
                    {!! Form::close() !!}
                </a>
            </li>
            <li>
                <a>
                    {!! Form::open(['url' => '/AboutAWeekAgo']) !!}
                      {!! Form::submit('Last Week Videos') !!}
                    {!! Form::close() !!}
                </a>
            </li>
     </ul>

     {!! Form::open(['url' => '/search']) !!}

        {!! Form::text('data',null,['class' => 'form-control',
         'id' => 'search_bar',
         'placeholder' => 'Search specific content' ]) !!}

     {!! Form::close() !!}

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>