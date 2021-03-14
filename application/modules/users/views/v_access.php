
<!-- start page title -->
<div class="row justify-content-md-center">
    <div class="col-4">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"><i class="fas fa-list"></i>&nbsp; User Access </h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row justify-content-md-center">
    <div class="col-4">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <form method="POST" action="<?=base_url('users/access_submit');?>">
                    <input type="hidden" name="users_uuid" value="<?=$users_uuid;?>">
                    <table class="table table-bordered table-striped table-nowrap mb-0">
                        <tbody>
                            <?php
                            if (count($module) > 0) 
                            {
                                foreach ($module as $key => $row) 
                                {
                                    $checked = "";
                                    $checkID    = array_search($row['module_id'], $access_list);
                                    if ($checkID > 0 && $checkID !="" && !is_null($checkID)) 
                                    {
                                        $checked = "checked";
                                    }

                                    echo '<tr>
                                            <th width="17%">'.$row['module_label'].'</th>
                                            <td><input type="checkbox" name="selected[]" '.$checked.' value="'.$row['module_id'].'"></td>
                                        </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="card-footer text-right">
                      <button type="button" class="btn btn-secondary" onclick="history.back(-1)"><i class="fas fa-angle-left"></i>&nbsp; Back</button>
                      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->

</div>
<!-- end row -->