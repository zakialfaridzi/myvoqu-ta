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



                        <div class="friend-info">



                            <h5><a href="<?=base_url('friend/visitProfile/') . $au->id;?>"><?=$au->name;?></a></h5>
                            <p>Student at Harvard</p>


                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#myModal">Infaq</button>
                        <div style="margin-top: 0px;">
                        </div>


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
                    <div class="modal-body">

                        <form action="<?=base_url('infaq/addInfaq')?>">

                            <div class="alert alert-warning alert-dismissible show" role="alert">
                                <strong>Hallo orang baik!</strong> kami tidak menepatkanbatas minimal atau maksimal
                                infaq ya
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="cont">

                                <div class="stars">

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

                                </div>
                                <p>click the stars</p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Nominal Infaq</label>
                                <input type="number" class="form-control" id="exampleInputPassword1"
                                    placeholder="1000000" name="jumlah">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>

                    </form>
                </div>

            </div>
        </div>



    </div>






</div>




<script src="<?=base_url('assets_user/js/search.js');?>"></script>

</div>

<script src="<?=base_url('assets_user/js/search.js');?>"></script>


<?=$this->session->flashdata('pesan')?>
