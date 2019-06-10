@extends('layouts.front')
@section('content')
    <div id="map" style="position: unset"></div>
    <div class="cotainer">
        <div class="bars">
            <button><i class="fas fa-bars"></i></button>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="tab">
                <div class="search">
                    <h2>Affiliated <br/> Optometrists</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi assumenda at aut autem,
                        consequatur consequuntur debitis dolore earum esse fuga id molestiae nobis, omnis quas quidem
                        quisquam suscipit tempore?
                    </p>
                    <form>
                        <div class="form-group">
                            <i class="fa fa-search"></i>
                            <input type="text" name="search" class="form-control search_by" placeholder="Search a name, city or zip...">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                        <br/>
                        <h6><a href="#">Or, View All Doctors</a></h6>
                    </form>
                </div>
                <div class="doctors">
                    <a href="#" class="back"> <i class="fas fa-chevron-left"></i> Back to Search</a>
                    <div class="list">
                        {{--<div class="media">--}}
                        {{--<img class="mr-3" src="https://dummyimage.com/50x50/000/fff" alt="Generic placeholder image"/>--}}
                        {{--<a href="#">--}}
                        {{--<div class="media-body">--}}
                        {{--<h5 class="mt-0">Jessica Graham</h5>--}}
                        {{--<p>--}}
                        {{--Valley View Vision--}}
                        {{--<br/>--}}
                        {{--Riverton, UT, 84096--}}
                        {{--</p>--}}
                        {{--</div>--}}
                        {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="single-doctor">
                    <a href="#" class="back"> <i class="fas fa-chevron-left"></i> Back to Search</a>
                    <div class="profile">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
