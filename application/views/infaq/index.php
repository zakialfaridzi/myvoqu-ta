<div class="friend-list">
    <div class="row">
        <div id="container">
            <?php foreach ($otherUser as $au): ?>
            <div class="col-md-6 col-sm-6">
                <div class="friend-card">
                    <img src="<?=base_url('assets_user/');?>images/covers/1.jpg" alt="profile-cover"
                        class="img-responsive cover" />
                    <div class="card-info">
                        <img src="<?=base_url('assets_user/')?>images/<?=$au->image;?>" alt="user"
                            class="profile-photo-lg" />

                        <?php if (is_null($au->avg_rating)): ?>

                        <a class="badge" style="background-color: darkorange;">mentor baru</a>

                        <?php else: ?>

                        <a class="badge" style="background-color: darkorange;"><?=$au->avg_rating?> <i
                                class="fas fa-star"></i></a>

                        <?php endif;?>

                        <a class="badge" style="background-color: deepskyblue;">Mentor</a>


                        <div class="friend-info">



                            <h5><a href="<?=base_url('friend/visitProfile/') . $au->id;?>"><?=$au->name;?></a></h5>
                            <p>Mentor MyVoQu</p>


                        </div>
                        <a class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="<?=$au->id?>"
                            id="showInfaqModal">Infaq</a>

                        <button type=" button" class="btn btn-success">
                            Testimoni <i class="fas fa-quote-right"></i></button>




                    </div>

                </div>
            </div>
            <?php endforeach;?>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Infaq Itu Indah <i class="fas fa-smile"></i></h4>
                    </div>
                    <div class="modal-body" id="modal_view">


                        <form action="<?=base_url('infaq/addInfaq')?>" method="POST">
                            <input type="hidden" value="" name="id_mentor" id="idMentor">
                            <div class="alert alert-warning alert-dismissible show" role="alert">
                                <strong>Hallo orang baik!</strong> kami tidak menepatkan batas minimal atau maksimal
                                infaq ya
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="cont">

                                <div class="stars" style="width: 300px;margin-top:12px;align-self: center;">
                                    <center>
                                        <input class="star star-5" id="star-5" type="radio" name="star" />
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" name="star" />
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" name="star" />
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" name="star" />
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" name="star" />
                                        <label class="star star-1" for="star-1"></label>

                                        <input type="hidden" value="0" name="rating" id="rating">


                                    </center>
                                </div>





                                <p>click the stars</p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nominal Infaq</label>
                                <input type="number" class="form-control" id="exampleInputPassword1"
                                    placeholder="1000000" name="jumlah" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <input type="submit" class="btn btn-info" value="Submit" id="submittt">
                    </div>





                    </form>
                </div>

            </div>
        </div>




    </div>






</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

    $("#star-1").click(function() {
        $("#rating").val("1");
    });
    $("#star-2").click(function() {
        $("#rating").val("2");
    });
    $("#star-3").click(function() {
        $("#rating").val("3");
    });
    $("#star-4").click(function() {
        $("#rating").val("4");
    });
    $("#star-5").click(function() {
        $("#rating").val("5");
    });
});
</script>





<script src="<?=base_url('assets_user/js/search.js');?>"></script>

</div>

<script src="<?=base_url('assets_user/js/search.js');?>"></script>




<?=$this->session->flashdata('pesan')?>
<script type="text/javascript">
$(document).on("click", "#showInfaqModal", function() {
    var idmentor = $(this).data('id');

    $("#modal_view #idMentor").val(idmentor);


});
</script>