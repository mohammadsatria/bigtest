@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
          <h4>{{ $subTitle }}</h4>
          <div class="clearfix"></div>
        </div>
      <div class="x_content">

          <div id="html1">
            <ul>
          @foreach ($data as $lev1 => $val)
          	    <li id="lev-1-{{ $val['id'] }}"  class="jstree-open">{{ $lev1 }}
                    @if(count($val['child']) == 0)
                </li>
                    @else
                        <ul>
                        @foreach ($val['child'] as $lev2 => $val2)
                            <li id="lev-2-{{ $val2['id'] }}"  class="jstree-open">{{ $lev2 }}
                                @if(count($val2['child']) == 0)
                            </li>
                                @else
                            <ul>
                                @foreach ($val2['child'] as $lev3 => $val3)
                                    <li  id="lev-3-{{ $val3['id'] }}" class="jstree-open">{{ $lev3 }}</li>
                                @endforeach
                            </ul>
                                @endif
                        @endforeach
                        </ul>

                    @endif
          	    </li>
          @endforeach
              </ul>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-5">
              <button type="button" onClick="LIBS._goToPage('{{ route('usertype-index') }}')" class="btn btn-dark">Back</button>
              <input type="hidden" name="usertypeId" id="usertypeId" value="{{ $usertypeId }}">
              <button id="submit" type="button" onClick="accessStore()" class="btn btn-primary">Save</button>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>
@endsection
