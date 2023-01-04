@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <div class="col-lg-12 col-xs-12 tab-content">
        <div class="container">
            <div class="row justify-content-md-center align-items-center">
                <div class="col-md-7  offset-md-1">
                    <h1>What would you like to do? {{$request->token}}</h1>
                </div>
                <div class="col-md-7  mt-5">
                    <div class="row">
                        <!--================ start of generate link ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="generateLink" action="{{ route('generate-link')}}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg extra-lg-btn">Generate New Link</button>
                            </form>
                        </div>
                        <!--================ start of Deactivate link ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="deactivateLink" action="{{ route('deactivate-link')}}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-lg extra-lg-btn">Deactivate Link</button>
                            </form>
                        </div>
                        <!--================ start of I'm felling lucky ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="feelingLucky" action="{{ route('feeling-lucky')}}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-lg extra-lg-btn">I'm Feeling Lucky</button>
                            </form>
                        </div>
                        <!--================ start of History ===============================================-->
                        <div class="col-md-6  mt-5">
                            <form method="post" class="history" action="{{ route('history')}}">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-lg extra-lg-btn">History</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    url:"{{ route('user.store')}}",
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
                    },
                    error:function(xhr){
                        var data = xhr.responseJSON;

                        if($.isEmptyObject(data.errors) == false){
                            $.each(data.errors, function(key, result){
                                $('.result').show();
                                $(".submitLoader").hide();
                                $('.result').html(result);
                            });
                        }
                    }
                })
            }))
        })

    </script>
@endsection
