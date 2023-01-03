@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <main role="main" class="container starter-template">
        <div class="row">
            <div id="response"></div>
            <div class="col-lg-12 col-xs-12 tab-content">
                <div class="ftco-blocks-cover-1" style="margin-top: -150px;">
                    <div class="site-section-cover overlay">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h1 class="mb-3 text-primary">Create Your Profile</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-section">
                    <div class="container">
                        <div id="posts" class="row no-gutter">

                            <div class="col-lg-8 offset-lg-2 col-md-9 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form method="post" class="addNew_data" action="{{ route('user.store')}}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control" name="username" aria-describedby="usernameHelp">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number" aria-describedby="phoneHelp">
                                            </div>
                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-primary mb-4">Submit</button>
                                            </div>
                                            <div class="submitLoader searchLoader" style="margin-left: 100px; margin-top: -73px;"></div>
                                            <p class="alert alert-info result" style="margin-left: 0px; margin-top: -3px; display: none;"></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".addNew_data").on("submit", (function(e){
                e.preventDefault();
                $(".submitLoader").show();
                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                    }
                });

                $.ajax({
                    url:{{ route('user.store')}},
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        $(".submitLoader").hide();
                        $('.result').show();
                        $('.result').html(data);
                        if(data == "Profile data uploaded successfully") {
                            $(".addNew_data")[0].reset();
                        }
                    }
                })
            }))
        })

    </script>
@endsection
