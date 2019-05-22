@extends('layouts.front')
@section('content')
    <div class="map">
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
                                <input type="text" name="search" class="form-control" placeholder="Search a name, city or zip...">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <br/>
                            <h6><a href="#">Or, View All Doctors</a></h6>
                        </form>
                    </div>
                    <div class="doctors">
                        <a href="#" class="back"> < Back to Search</a>
                        <div class="list">
                            <div class="media">
                                <img class="mr-3" src="https://dummyimage.com/50x50/000/fff" alt="Generic placeholder image"/>
                                <a href="#">
                                    <div class="media-body">
                                        <h5 class="mt-0">Jessica Graham</h5>
                                        <p>
                                            Valley View Vision
                                            <br/>
                                            Riverton, UT, 84096
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="single-doctor">
                        <a href="#" class="back"> < Back to Search</a>
                        <div class="profile">
                            <div class="cover">
                                <img src="https://dummyimage.com/500x300/000/fff" class="img-responsive"/>
                                <div class="display-picture">
                                    <img src="https://dummyimage.com/50x50/000/fff" />
                                </div>
                            </div>
                            <div class="content">
                                <h5>Jessica <br/> Graham</h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, facilis fugiat ipsa iste natus nesciunt nulla officia placeat, quod saepe tempore temporibus ullam voluptatum. Accusamus consectetur laborum molestiae porro vitae?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
