<!DOCTYPE html>
<html lang="pl">
  <head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mateusz Domurad" />

    <title>Zaakceptuj nowe slangi &mdash; Programistyczny Slang</title>

    <!-- Bootstrap & Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />

    <!-- Custom fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,900&amp;subset=latin-ext" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,700&amp;subset=latin-ext" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300&amp;subset=latin-ext" rel="stylesheet" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
    <link href="{{ URL::asset('css/main.css?' . time()) }}" rel="stylesheet" />

  </head>
  <body>

      <main id="main-container">

          <nav class="nav nav-main">
              <div class="container-fluid">
                  <div class="row h-100">
                      <div class="col-12 my-auto logo text-center">
                          <h1>
                            <a href="{{ URL::to('/') }}" class="underline-link">Programistyczny Slang</a>
                          </h1>
                      </div>
                      <div class="col-12 my-auto letters text-center">
                          <ul class="list-inline">
                              @php ( $letters = App\Slang::getLetters() )
                              @foreach ( $letters as $letter )
                                  <li class="list-inline-item">
                                      <a href="{{ URL::to('/letter/' . $letter) }}" {{ Request::is('letter/' . $letter) ? 'class=active' : '' }}>{{ $letter }}</a>
                                  </li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
          </nav>

          <main id="main-content">

              <div class="container">
                  <div class="row h-100">

                      @yield('content')

                      <div class="options-left col-12 col-md-3">
                          <div class="my-auto letters">
                              <ul class="list text-right">
                                @if ( auth()->user() === null )
                                  <li class="list-item">
                                    <a href="{{ URL::to('/login') }}">
                                      Zaloguj się
                                      <i class="fas fa-sign-in-alt"></i>
                                    </a>
                                  </li>
                                @else
                                  <li class="list-item">
                                    <a href="{{ URL::to('/user/' . auth()->user()->name) }}">
                                      {{ auth()->user()->name }}
                                      <i class="fas fa-user"></i>
                                    </a>
                                  </li>
                                @endif
                                @hasrole('admin')
                                  <li class="list-item">
                                    <a href="{{ URL::to('/slang/acceptslangs') }}">
                                      <span class="badge badge-red">{{ App\Slang::getSlangsToAcceptCount() }}</span>
                                      Zaakceptuj slangi
                                      <i class="fas fa-check"></i>
                                    </a>
                                  </li>
                                @endhasrole
                                  <li class="list-item">
                                      <a href="{{ URL::to('/slang/create') }}">
                                          Dodaj slang
                                          <i class="fas fa-plus"></i>
                                      </a>
                                  </li>
                                  <li class="list-item">
                                      <a href="{{ URL::to('/slang/random') }}">
                                          Losuj slang
                                          <i class="fas fa-random"></i>
                                      </a>
                                  </li>
                                  <li class="list-item">
                                      <a href="{{ URL::to('/rankings') }}">
                                          Rankingi
                                          <i class="fas fa-medal"></i>
                                      </a>
                                  </li>
                                  @if ( auth()->user() !== null )
                                    <li class="list-item">
                                      <a href="{{ URL::to('/logout') }}">
                                        Wyloguj się
                                        <i class="fas fa-sign-out-alt"></i>
                                      </a>
                                    </li>
                                  @endif
                              </ul>
                          </div>
                      </div>

                  </div>
              </div>

          </main>

      </main>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  </body>
</html>
