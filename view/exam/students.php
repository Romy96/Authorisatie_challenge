<h1>Studenten</h1>

<div class="row">
        <div class="col-xs-12">
        <div class="row">
            <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="<?=URL?>exam/create_student" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-plus" aria-hidden="true"></i> Nieuwe student
                    </a>
            </div>
        </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="products" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Email</th>
                            <th data-sortable="false">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
						
						<?php
                        if(isset($students)):
                            foreach($students as $row):
                        ?>
                                <tr>
                                    <td>
                                        <a href="<?=URL?>exam/exam_user/<?=$row['id']?>"><?=$row['firstname']?></a>
                                    </td>
                                    <td>
                                    	<a href="<?=URL?>exam/exam_user/<?=$row['id']?>"><?=$row['prefix']?> <?=$row['lastname']?></a>
                                    </td>
                                    <td>
                                        <a href="<?=URL?>exam/exam_user/<?=$row['id']?>"><?=$row['email']?></a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?=URL?>exam/edit_student/<?=$row['id']?>" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=URL?>exam/delete_student/<?=$row['id']?>" onclick="return confirm('Weet je het zeker?')" class="btn btn-default btn-flat"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>