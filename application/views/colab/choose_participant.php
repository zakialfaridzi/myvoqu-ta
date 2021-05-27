<header>
    <h1></h1>
</header>





<main>



    <a href="<?=base_url('colab/doColab/')?>" target="_blank" class="btn btn-info" style="margin-bottom: 10px;">Mulai
        Video Call</a>

    <div class="card" style="width: 100%;margin-bottom: 20px;">
        <div class="card-body" style="padding:10px;">
            <h5 class="card-title"><i class="fas fa-broadcast-tower"></i> &ensp; Masukkan Link Siaran</h5>


            <div class="form-group">
                <!-- <label for="exampleInputEmail1">Link Siaran</label> -->
                <input type="text" class="form-control" id="kode" aria-describedby="emailHelp"
                    placeholder="Contoh: https://8d858c329b67.ap.ngrok.io/myvoqu/colab/doColab/#f4bc60">
                <small><i>Copy paste kan link siaran yang diberikan oleh teman anda!</i></small>

            </div>

            <button id="myButton" class="btn btn-primary" style="display: none;">Masuk</button>


        </div>
    </div>

    <script>
    $("#kode").keyup(function() {
        if (document.getElementById('kode').value.length == 0) {
            // do stuff
            $('#myButton').hide();
        } else {
            $('#myButton').show();

        }
        // $('#errorMsg').hide();

    });
    </script>

    <script type="text/javascript">
    var code = "";

    document.getElementById("myButton").onclick = function() {

        code = document.getElementById('kode').value;
        // alert(code);
        location.href = code;
    };
    </script>



</main>



</div>