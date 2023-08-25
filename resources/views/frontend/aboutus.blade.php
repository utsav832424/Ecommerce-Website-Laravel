@extends('frontend.layout.master')
@section('title','E-SHOP || ABOUT US')
@section('main-content')
<div class="page-content">
    
    <div class="holder fullboxed mt-0 py-5 py-md-10 bg-cover" style="background-image:url('https://www.thevintagegarments.com/Assets/images/about/slider-3.png')">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="text-center">
                        <p><img height="500px" width="300px" src="{{asset('frontend/img/bigger.png')}}" alt="" class="img-fluid"></p>
                        <p style="color: #001454;font-weight: 600;">With Bigger, your imagination is at your fingertips.Our mission is to become The Make Engine to give people the power to make anything imaginable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="holder">
        <div class="container">
            <h2 class="h1-style text-center">Why Us</h2>
            <div class="row vert-margin">
                <div class="col-sm-3">
                    <div class="block-it text-center">
                        <div class="block-it-icon"><i class="icon-box3"></i></div>
                        <h3 class="text-uppercase">Free worlwide delivery</h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="block-it text-center">
                        <div class="block-it-icon"><i class="icon-tag"></i></div>
                        <h3 class="text-uppercase">Promotions, bonuses and discounts</h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="block-it text-center">
                        <div class="block-it-icon"><i class="icon-circle-dollar"></i></div>
                        <h3 class="text-uppercase">Free secret Reward Card</h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="block-it text-center">
                        <div class="block-it-icon"><i class="icon-gift2"></i></div>
                        <h3 class="text-uppercase">Presents to our customers</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="holder py-3 py-md-6 holder-bg-14">
        <div class="container">
            <h2 class="h1-style text-center">Our History</h2>
            <div class="timeLine timeLine--twocols loaded">
                
                
                
                
                <!-- <div class="timeLine-item">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/1.png" alt="">
                        <div class="timeLine-item-text">
                            <h5>We're glad you're here.</h5>
                            <p>Looking through our marketplace, you'll find Designers selling their art,Makers showcasing their customizable products, and create-your-own products just waiting for You.</p>
                        </div>
                    </div>
                </div>
                <div class="timeLine-item">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/1.png" alt="">
                        <div class="timeLine-item-text">
                            <h5>Our People</h5>
                            <p>The people of  The Vintage Garment are just as diverse and unique as our products. We're PhD's, professional artists, manufacturing gurus, patent holders, inventors, musicians, and more. Our common thread? A passion for going beyond the ordinary. Whether we're improving our technologies, building your latest creation, or adding new products, everything we do is an expression of love</p>
                        </div>
                    </div>
                </div>
                <div class="timeLine-item">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/aboutus5.jpg" alt="">
                        <div class="timeLine-item-text">
                            <h5>1990</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                        </div>
                    </div>
                </div>
                <div class="timeLine-item">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/aboutus4.jpg" alt="">
                        <div class="timeLine-item-text">
                            <h5>1995</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                        </div>
                    </div>
                </div> -->
               
            <div class="timeLine-left"><div class="timeLine-item" data-order="0" data-col="left">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/1.png" alt="">
                        <div class="timeLine-item-text">
                            <h5>Mission</h5>
                            <p>The Vintage Garment is a company that works with designers to bring the world millions of designs on hundreds of different products. Our mission is to create human connection by inspiring people to express themselves.</p>
                        </div>
                    </div>
                </div><div class="timeLine-item" data-order="2" data-col="left">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/aboutus5.jpg" alt="">
                        <div class="timeLine-item-text">
                            <h5>Our Promise</h5>
                            <p>At The Vintage Garments we strive to inspire people to express themselves with the best assortment of engaging merchandise. Our customer service experience was made with you in mind, because you are the best part of us</p>
                        </div>
                    </div>
                </div></div><div class="timeLine-right"><div class="timeLine-item" data-order="1" data-col="right">
                    <div class="timeLine-item-image">
                        <img src="https://www.thevintagegarments.com/Assets/images/about/21.png" alt="" height="398" width="400">
                        <div class="timeLine-item-text">
                            <h5>Our People</h5>
                            <p>The people of  The Vintage Garment are just as diverse and unique as our products. We're PhD's, professional artists, manufacturing gurus, patent holders, inventors, musicians, and more. Our common thread? A passion for going beyond the ordinary. Whether we're improving our technologies, building your latest creation, or adding new products, everything we do is an expression of love</p>
                        </div>
                    </div>
                </div><div class="timeLine-item" data-order="3" data-col="right">
                    <div class="timeLine-item-image">
                        <img height="398" width="400" src="https://www.thevintagegarments.com/Assets/images/about/22.jpg" alt="">
                        <div class="timeLine-item-text">
                            <h5>Online Marketplace</h5>
                            <p>Our online marketplace is an evergrowing selection of designs to put on hundreds of products, from buttery soft t-shirts to trendy home decor. Our designs come from shopkeepers, fan portals, and licensed content.</p>
                        </div>
                    </div>
                </div></div></div>
        </div>
    </div>
    
</div>
@endsection