<div id="page-contents">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">

            <!-- About
              ================================================= -->

            <div class="about-profile">
                <?php foreach ($info as $i): ?>
                <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-information-outline icon-in-title"></i>Tentang
                        <?=$i->name?></h4>
                    <p><?=$i->bio?></p>
                </div>
                <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Pekerjaan</h4>
                    <div class="organization">
                        <img src="https://www.clipartkey.com/mpngs/m/102-1029067_student-flat-icon-www-pixshark-com-images-galleries.png"
                            alt="" class="pull-left img-org" />
                        <div class="work-info">
                            <h5><?=$i->work?></h5>
                            <?php endforeach?>
                        </div>
                    </div>

                </div>

                <!-- <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-location-outline icon-in-title"></i>Location</h4>
                    <p>228 Park Eve, New York</p>
                    <div class="google-maps">
                        <div id="map" class="map"></div>
                    </div>
                </div> -->
                <!-- <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-heart-outline icon-in-title"></i>Interests</h4>
                    <ul class="interests list-inline">
                        <li><span class="int-icons" title="Bycycle riding"><i
                                    class="icon ion-android-bicycle"></i></span></li>
                        <li><span class="int-icons" title="Photography"><i class="icon ion-ios-camera"></i></span></li>
                        <li><span class="int-icons" title="Shopping"><i class="icon ion-android-cart"></i></span></li>
                        <li><span class="int-icons" title="Traveling"><i class="icon ion-android-plane"></i></span></li>
                        <li><span class="int-icons" title="Eating"><i class="icon ion-android-restaurant"></i></span>
                        </li>
                    </ul>
                </div> -->
                <!-- <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-chatbubble-outline icon-in-title"></i>Language</h4>
                    <ul>
                        <li><a href="#">Russian</a></li>
                        <li><a href="#">English</a></li>
                    </ul>
                </div> -->
            </div>
        </div>