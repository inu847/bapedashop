@extends('layouts.buyer')

@section('title')
    Link Youtube
@endsection

@section('content')
    
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-10">
                                        <h3>Form Link Youtube</h3>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-warning add-more" type="button">
                                            <i class="simple-icon-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                                
                                <form action="{{ route('idVidioYt') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="control-group after-add-more">
                                    <label>Link Youtube</label>
                                    <input type="text" name="link[]" class="form-control col-md-12">
                                    </div>
                                    <button class="btn btn-danger mt-3" type="submit">Tonton</button>
                                </form>
                        
                                <div class="copy invisible">
                                    <div class="control-group">
                                        <hr>
                                        <label>Link Youtube</label>
                                        <input type="text" name="link[]" class="form-control">             
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

    //   $("body").on("click",".remove",function(){ 
    //       $(this).parents(".control-group").remove();
    //   });
    });
</script>