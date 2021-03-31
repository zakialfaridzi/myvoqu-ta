<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">MyVoqu Admin's To-Do List Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/index/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">MyVoqu Admin's To-Do List Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>


        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-download"></i> Export
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="<?php echo base_url('Admin/printTodo'); ?>" target="_blank" rel="noreferrer" class="dropdown-item"><i class="fa fa-print"></i> Print</a>
                <a href="<?php echo base_url('Admin/pdfTodo'); ?>" class="dropdown-item"><i class="fa fa-file"></i> PDF</a>
                <!-- <a href="<?php echo base_url('Admin/excelTodo'); ?>" class="dropdown-item"><i class="fa fa-file"></i> Excel</a> -->
            </div>
            &emsp;
        <?php echo anchor('Admin/createTodo', '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New To-Do</button>') ?>
        </div>


        <table class="table mt-2">
            <tr>
                <th>NO</th>
                <th>Nama Task</th>
                <th colspan="5">
                    <center>Action</center>
                </th>
            </tr>
            <?php $no = 1;
foreach ($todo as $u): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->task_name ?></td>
					<?php if ($u->state != 1): ?>
                        <td onclick="return confirm('Complete To-Do?');">
                        	<?php echo anchor('Admin/doneTodo/' . $u->id, '<div class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Done</div>') ?>
                    	</td>
                    <?php else: ?>
                        <td onclick="return confirm('Uncomplete To-Do?');">
                            <?php echo anchor('Admin/undoneTodo/' . $u->id, '<div class="btn btn-danger btn-sm"><i class="fas fa-check"></i> Undone</div>') ?>
                        </td>
                    <?php endif;?>
					<td>
                       	<?php echo anchor('Admin/editTodo/' . $u->id, '<div class="btn btn-info btn-sm"><i class="fa fa-check"></i> Edit</div>') ?>
                    </td>
					<td onclick="return confirm('Delete To-Do?');">
                        <?php echo anchor('Admin/deleteTodo/' . $u->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</div>') ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
