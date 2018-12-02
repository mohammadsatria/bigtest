              <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <h3>Menu</h3>
                  <ul class="nav side-menu">
                      @foreach ($menu as $idLevel1 => $val)
                          @if (count($val['child']) == 0)
                              {{-- level 1 --}}
                            <li><a href="{{ route($val['url']) }}"><i class="{{ $val['icon'] }}"></i> {{ $val['name'] }} </a></li>
                          @else
                              {{--  level 1 with child --}}
                            <li><a><i class="{{ $val['icon'] }}"></i> {{ $val['name'] }} <span class='fa fa-chevron-down'></span></a>
                            <ul class='nav child_menu'>
                                  @foreach ($val['child'] as $idLevel2 => $val2)
                                      @if (count($val2['child']) == 0)
                            <li><a href="{{ route($val2['url']) }}"> {{ $val2['name'] }} </a></li>
                                      @else
                            <li><a> {{ $val2['name'] }} <span class='fa fa-chevron-down'></span></a>
                            <ul class='nav child_menu'>
                                              @foreach ($val2['child'] as $idLevel3 => $val3)
                            <li><a href="{{ route($val3['url']) }}"> {{ $val3['name'] }} </a></li>
                                              @endforeach
                            </ul></li>
                                      @endif
                                  @endforeach
                            </ul></li>
                          @endif
                      @endforeach
                  </ul>
                </div>

              </div>
              <!-- /sidebar menu -->
