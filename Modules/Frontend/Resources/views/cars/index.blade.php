   @extends('frontend::layouts.master')
   @section('content')
 
    <section class="b-pageHeader">
        <div class="container">
            <h1 class="wow zoomInLeft" data-wow-delay="0.5s">Auto Listings</h1>
            <div class="b-pageHeader__search wow zoomInRight" data-wow-delay="0.5s">
                <h3>Your search returned 28 results</h3>
            </div>
        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.5s">
            <a href="home.html" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a href="listTable.html" class="b-breadCumbs__page m-active">Search Results</a>
        </div>
    </div>
    <!--b-breadCumbs-->

    <div class="b-infoBar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="b-infoBar__compare wow zoomInUp" data-wow-delay="0.5s">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle b-infoBar__compare-item" data-toggle='dropdown'><span class="fa fa-clock-o"></span>RECENTLY VIEWED<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="detail.html">Item</a></li>
                                <li><a href="detail.html">Item</a></li>
                                <li><a href="detail.html">Item</a></li>
                                <li><a href="detail.html">Item</a></li>
                            </ul>
                        </div>
                        <a href="compare.html" class="b-infoBar__compare-item"><span class="fa fa-compress"></span>COMPARE VEHICLES: 2</a>
                    </div>
                </div>
                <div class="col-lg-8 col-xs-12">
                    <div class="b-infoBar__select wow zoomInUp" data-wow-delay="0.5s">
                        <form method="post" action="/">
                            <div class="b-infoBar__select-one">
                                <span class="b-infoBar__select-one-title">SELECT VIEW</span>
                                <a href="listingsTwo.html" class="m-list m-active"><span class="fa fa-list"></span></a>
                                <a href="listTableTwo.html" class="m-table"><span class="fa fa-table"></span></a>
                            </div>
                            <div class="b-infoBar__select-one">
                                <span class="b-infoBar__select-one-title">SHOW ON PAGE</span>
                                <select name="select1" class="m-select">
                                    <option value="" selected="">10 items</option>
                                </select>
                                <span class="fa fa-caret-down"></span>
                            </div>
                            <div class="b-infoBar__select-one">
                                <span class="b-infoBar__select-one-title">SORT BY</span>
                                <select name="select2" class="m-select">
                                    <option value="" selected="">Last Added</option>
                                </select>
                                <span class="fa fa-caret-down"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--b-infoBar-->

    <div class="b-items">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/chevroletTable.jpg" alt='chevrolet' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-premium">PREMIUM</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check1" id='check1' />
                                        <label for="check1" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Chevrolet Silverado 1500</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$29,415</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/ferrariTable.jpg" alt='ferrari' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-listing">NE LISTING</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check2" id='check2' />
                                        <label for="check2" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">2015 Ferrari LaFerrar</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$1,420,112</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/maximaTable.jpg" alt='maxima' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-premium">PREMIUM</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check3" id='check3' />
                                        <label for="check3" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Nissan Maxima SV</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$68,213</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/mersTable.jpg" alt='mers' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check4" id='check4' />
                                        <label for="check4" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Mercedes-Benz GL63 AMG</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$29,415</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/audiTable.jpg" alt='audi' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-listing">NEW LISTING</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check5" id='check5' />
                                        <label for="check5" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Audi S4 3.0L V6 Turbo</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$63,218</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/toyotaTable.jpg" alt='toyota' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-premium">PREMIUM</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check6" id='check6' />
                                        <label for="check6" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Toyota RAV4 A Class</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$48,715</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/jaguarTable.jpg" alt='jaguar' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-owner">1 OWNER</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check7" id='check7' />
                                        <label for="check7" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Jaugar XF 250</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$68,213</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/mercTable.jpg" alt='merc' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check8" id='check8' />
                                        <label for="check8" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Mercedes Benz GL Class</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$33,580</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <div class="b-items__cell wow zoomInUp" data-wow-delay="0.5s">
                                <div class="b-items__cars-one-img">
                                    <img class='img-responsive' src="media/260x230/lexusTable.jpg" alt='lexus' />
                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-film"></span>VIDEO</a>
                                    <span class="b-items__cars-one-img-type m-listing">NEW LISTING</span>
                                    <form action="/" method="post">
                                        <input type="checkbox" name="check9" id='check9' />
                                        <label for="check9" class="b-items__cars-one-img-check"><span class="fa fa-check"></span></label>
                                    </form>
                                </div>
                                <div class="b-items__cell-info">
                                    <div class="s-lineDownLeft b-items__cell-info-title">
                                        <h2 class="">Lexus LS460F Sport</h2>
                                    </div>
                                    <p>In a pickup market gone fancy, the Silverado sticks to its basic-truck recipe. The steering is accurate, and the ...</p>
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-6">
                                            <ul>
                                                <li>Registered 2015</li>
                                                <li>Used</li>
                                                <li>8-Speed Automatic </li>
                                                <li>Petrol</li>
                                            </ul>
                                            <h5 class="b-items__cell-info-price">$1,420,112</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="b-items__cell-info-km">
                                                <span class="fa fa-tachometer"></span>
                                                <p>31,730 KM</p>
                                            </div>
                                            <a href="detail.html" class="btn m-btn">VIEW DETAILS<span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="b-items__pagination">
                        <div class="b-items__pagination-main wow zoomInUp" data-wow-delay="0.5s">
                            <a href="#" class="m-left"><span class="fa fa-angle-left"></span></a>
                            <span class="m-active"><a href="#">1</a></span>
                            <span><a href="#">2</a></span>
                            <span><a href="#">3</a></span>
                            <span><a href="#">4</a></span>
                            <a href="#" class="m-right"><span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>
                </div>
              

                @include('frontend::cars.filter')

            </div>
        </div>
    </div>
    <!--b-items-->

    @endsection