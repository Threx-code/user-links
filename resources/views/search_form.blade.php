<div class="container" style="margin-bottom: 20px;">
    <div class="row">
        <div class="col-md-5 ">

            <form method="get" class="searchCodeForm" action="{{ route('search')}}">
                <div class="form-row">
                    <div class="col-12 mb-3">
                        <input type="text" name="distributor" class="form-control search_input" placeholder="Distributor">
                    </div>
                    <div class="col">
                        <input type="text" name="from_date" class="form-control" placeholder="From Date">
                    </div>
                    <div class="col">
                        <input type="text" name="to_date" class="form-control" placeholder="To Date">
                    </div>
                    <div class="col-auto">
                        <button type="submit"  class="btn btn-primary mb-2">Filter</button>
                    </div>
                </div>
                @csrf
            </form>

        </div>

        <div class="col-md-4 offset-2">
            <form action="search" method="post">
                <div class="input-group">
                    <input type="text" class="form-control search_input" name="search" placeholder="Enter your search" autofocus>
                </div>

                @csrf
                <img src="{{ asset('images/search-grey.png') }}" class="searchImg" style="position: relative; z-index: 10; float: right; margin-right: 10px; margin-top: -30px; cursor: pointer;">
                <input type="submit" style="display: none;" class="searchButton">
            </form>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".searchImg").on("click", function(){
            $(".searchButton").click();
        })
    })


    $( ".search_input" ).autocomplete({
        source: "{{ route('autocomplete')}}",
    });
</script>
