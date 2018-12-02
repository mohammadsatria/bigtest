<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
          <div class="row">
              <div class="col-md-9">
                  <button type="button" id="add-button" class="btn btn-round btn-primary" onClick="LIBS._goToPage('{{route('menu-add')}}')"><i class="fa fa-plus"></i> New Menu</button>
              </div>

              <div class="col-md-3 form-group pull-right top_search">
                  <div class="input-group">
                      <input type="text" onkeyup="doSearch()" class="form-control" id="search" placeholder="Search for...">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go!</button>
                      </span>
                  </div>
              </div>
          </div>

          <table id="table-menu" class="table jambo_table">
            <thead>
              <tr>
                <th width="70%">Menu</th>
                <th>Icon</th>
                <th>Status</th>
                <th id="action">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($data as $key => $val) {
                ?>
                    <tr>
                        <td>{{ '('.$no. ')' }} {{ $key }}</td>
                        <td align="center"><i class="{{ $val['icon'] }} fa-lg"></i></td>
                        <td align="center"><span class="label {{ $val['active'] == 1 ? 'label-primary' : 'label-danger'  }} btn-round">{{ $val['active'] == 1 ? 'Active' : 'Non Active' }}</span></td>
                        <td align="center" id="action">
                            <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{ route('menu-edit', [ 'id' => $val['id'], 'level' => 1  ]) }}');" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                            <i class="fa fa-trash fa-lg action" data-toggle="tooltip" onClick="destroy('{{ $val['id'] }}', 1)" title="Delete" data-original-title="Delete"></i>
                        </td>
                    </tr>
                        <?php
                            if(count($val['child']) > 0){
                                $noLev2 = 1;
                                foreach ($val['child'] as $lev2 => $val2){
                        ?>
                                <tr>
                                    <td style="padding-left: 4%">{{ '('.$noLev2. ')' }} {{ $lev2 }}</td>
                                    <td align="center"></td>
                                    <td align="center"><span class="label {{ $val2['active'] == 1 ? 'label-primary' : 'label-danger'  }} btn-round">{{ $val2['active'] == 1 ? 'Active' : 'Non Active' }}</span></td>
                                    <td align="center" id="action">
                                        <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{ route('menu-edit', [ 'id' => $val2['id'], 'level' => 2  ]) }}');" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                                        <i class="fa fa-trash fa-lg action" data-toggle="tooltip" onClick="destroy('{{ $val2['id'] }}', 2)" title="Delete" data-original-title="Delete"></i>
                                    </td>
                                </tr>
                                <?php
                                    if(count($val2['child']) > 0){
                                        $noLev3 = 1;
                                        foreach ($val2['child'] as $lev3 => $val3){
                                ?>
                                        <tr>
                                            <td style="padding-left: 8%">{{ '('.$noLev3. ')' }} {{ $lev3 }}</td>
                                            <td align="center"></td>
                                            <td align="center"><span class="label {{ $val3['active'] == 1 ? 'label-primary' : 'label-danger' }} btn-round">{{ $val3['active'] == 1 ? 'Active' : 'Non Active' }}</span></td>
                                            <td align="center" id="action">
                                                <i class="fa fa-pencil fa-lg action" onClick="LIBS._goToPage('{{ route('menu-edit', [ 'id' => $val3['id'], 'level' => 3  ]) }}');" data-toggle="tooltip" title="Edit" data-original-title="Edit"></i>
                                                <i class="fa fa-trash fa-lg action" data-toggle="tooltip" onClick="destroy('{{ $val3['id'] }}', 3)" title="Delete" data-original-title="Delete"></i>
                                            </td>
                                        </tr>
                                        <?php
                                            $noLev3++;
                                        }
                                    }
                                ?>
                                <?php
                                    $noLev2++;
                                }
                            }
                        ?>
                <?php
                    $no++;
                    }
                ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
