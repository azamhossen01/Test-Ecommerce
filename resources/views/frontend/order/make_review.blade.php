@extends('layouts.frontend')

@push('css')
<style>

.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 2vw;
    color: #FFD600;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}   
</style>
@endpush

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart </li>
            </ol>
        </div>
    </nav>

    <div class="container mb-6">
        <div class="row">
            <div class="col-lg-12 content-justify-center">



                <div class="add-product-review">
                    <form action="{{route('review.store')}}" class="comment-form m-0" method="post">
                        @csrf
                                <input type="hidden" name="order_detail_id" value="{{$order_detail_id}}">
                        <h3 class="review-title">Add a Review</h3>

                        <div class="rating-form">
                            <label for="rating">Your rating</label>
                            <span class="rating-stars">
                                <!-- <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a> -->
                                <div class="rating"> 
                                    <!-- <input type="text" name="rating"> -->
                                    <input type="radio" name="rating" value="5" checked id="5"><label for="5">☆</label> 
                                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                    @error('rating') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
  
                                
                            </span>

                            
                        </div>

                        <div class="form-group">
                            <label>Your Review</label>
                            <textarea cols="5" rows="6" name="comments" class="form-control form-control-sm"></textarea>
                            @error('comments') <small class="text-danger">{{$message}}</small> @enderror
                        </div><!-- End .form-group -->


                        <input type="submit" class="btn btn-dark ls-n-15" value="Submit">
                    </form>
                </div><!-- End .add-product-review -->







            </div><!-- End .col-lg-8 -->


        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->

@endsection

@push('js')
<script>

</script>
@endpush