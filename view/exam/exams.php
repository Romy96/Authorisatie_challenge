<h1>Studenten</h1>

<div class="row">
        <div class="col-xs-12">
        <div class="row">
            <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="<?=URL?>exam/create_exam" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-plus" aria-hidden="true"></i> Nieuwe examen
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
                            <th>Examen</th>
                            <th>Datum en tijd</th>
                            <th>Examinator</th>
                            <th>Uitslagen</th>
                            <th data-sortable="false">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
						
						<?php
                        if(isset($exams)):
                            foreach($exams as $row):
                        ?>
                                <tr>
                                    <td>
                                        <?=$row['exam']?>
                                    </td>
                                    <td>
                                    	<?=$row['date_time']?>
                                    </td>
                                    <td>
                                       <?=$row['examiner']?>
                                    </td>
                                    <td>
                                    	<a href="<?=URL?>exam/exam_results/<?=$row['id']?>">Klik hier</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?=URL?>exam/edit_exam/<?=$row['id']?>" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
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