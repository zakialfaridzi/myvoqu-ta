<!-- Chat Room
            ================================================= -->

<!-- https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css
https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css -->



<div class="chat-room">
    <div class="row">
        <div class="col-sm-12">
            <!-- Contact List in Left-->

            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nominal</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th>Status</th>



                    </tr>
                </thead>
                <tbody>
                    <?php
$no = 1;
foreach ($transaksi_wallet as $tw): ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td>
                            <?="Rp" . number_format($tw->gross_amount, 2, ',', '.')?>

                        </td>
                        <td><?=$tw->payment_type . " (" . strtoupper($tw->bank) . ")"?></td>
                        <td><?=$tw->transaction_time?></td>
                        <td>
                            <?php if ($tw->status_code == 201): ?>
                            <a class="badge badge-danger" style="background-color: red;">Pending</a>
                            <?php else: ?>
                            <a class="badge badge-success" style="background-color: forestgreen;">Berhasil</a>
                            <?php endif;?>
                        </td>


                    </tr>
                    <?php endforeach;?>

                    <?php foreach ($transaksi_infaq as $ti): ?>

                    <tr>
                        <td><?=$no++?></td>
                        <td>
                            <?="Rp" . number_format($ti->nominal, 2, ',', '.')?>

                        </td>
                        <td>
                            Infaq
                        </td>
                        <td>
                            <?=$ti->tanggal_infaq?>
                        </td>

                        <td>
                            <a class="badge badge-success" style="background-color: forestgreen;">Berhasil</a>
                        </td>

                    </tr>

                    <?php endforeach?>


                </tbody>

            </table>
            <!--Contact List in Left End-->
        </div>
        <!--Chat Messages in Right End-->
    </div>
</div>

</div>

<!-- https://code.jquery.com/jquery-3.5.1.js
https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js
https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js -->