
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Bidding Site | Home</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('front/bootstrap.min.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('front/dashboard.css') }}" rel="stylesheet">

     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>

  </head>
  <style>
    #title{
      font-weight:500; 
      font-size:18pt;
    }

    #date_created {
      padding:10px 0px 5px 20px;
    }

    #price {
      font-weight: 700;
      font-size: 10pt;
    }

    #noBids {
      margin:0 auto;
      text-align: center;
      font-size: 14pt;
    }

    .title{
      font-size: 16pt;
      text-align: center;
    }

    /* .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    } */

    .modal-body{
        height: 500px;
        overflow-y: auto;
    }
  </style>
  <body>
  <div id="app">
    <header>
    
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Bidding Site</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
          <ul class="navbar-nav ml-auto pr-4">
            <li class="nav-item active">
              
              <a  class="nav-link" href="{{ url('/') }}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li> --}}
            <li class="nav-item">
             <!--  <a class="nav-link" href="#">Login</a> -->
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>

            
            
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

    </header>

    <main role="main">

      <section class="jumbotron text-center pt-5">
        <div class="container">
          <h1 class="jumbotron-heading">Welcome....</h1>
          <p class="lead text-muted">The following are the products created by the administrators</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Send Us an Email</a>
            <a href="#" class="btn btn-secondary my-2">Contact Details</a>
          </p>
        </div>
      </section>


    
      
        <div class="album py-5 bg-light">
          <div class="container">

            <div class="row">

             @forelse ($products as $product)
                  <div class="col-md-4">
                    <p id="title">{{ $product->name }}</p>
                    <div class="card mb-4 shadow-sm">
                      <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_170109c355c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_170109c355c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                      <span id="date_created" >
                        <strong>Posted:</strong> {{ $product->created_at->diffForHumans() }}
                      </span>
                      <div class="card-body">
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary productButton" data-productid={{ $product->id }}  data-target="product" data-toggle="product">View Bids</button>
                            
                            <input type="hidden">
                          </div>
                          <small class="text-muted"><span id="price" >Price: R{{ number_format($product->price) }}.00</span></small>
                        </div>
                        {{-- <input type="hidded" value="{{ $product->id }}"> --}}
                      </div>
                    </div>
                  </div>
                
              @empty
                  <p class="alert alert-danger" id="noBids">There are no Products at the moment. Please check again later....</p>
                  
              @endforelse  

              
              
       

              </div>

              <div class="row">
                <div class="col-md-6 col-md-offset-5">
                  {{ $products->links() }}
                </div>
                
              </div>

            </div>
          </div>
        </div>
      


    </div>

    <!-- larg modal -->
    <div class="modal" id="logQuery" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
              
                  <h5 class="modal-title h4" id="myLargeModalLabel">Product | Bids</h5>
                  <!-- <span v-if="loading" style="padding-left:30%;"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></span> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
              </div>
          
          
              <div class="modal-body">
                  
                      
                    <div class="row mb-5">

                      <div class="col-md-12">
                          <div class="myMessage"></div>
                      </div>
                      <div class="col-md-12">
                        <h5>Bids To Product</h5>
                        <table class="table">
                            <thead>
                           
                              {{-- <th>Name</th> --}}
                              <th>Email</th>
                              <th>Price</th>
                              
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                      </div>
                      
                    </div>
                  
                    
                        
                    <div class="row">
                              <div class="col-md-12">
                                 <h4>Bid Yours</h4>  
                              </div>         
                              <div class="col-md-12">
                                  <form id="BiddingForm" action="{{ route("bids.store") }}">
                                    @csrf
                                      <div class="form-group">
                                          <label for="email">Email</label>
                                          <input type="email" name="email" id="email" class="form-control">
                                          <span id="email-error" class="error"></span>
                                      </div>

                                      
                                      <div class="form-group">
                                          <label for="price">Price</label>
                                          <input type="number" id="price" name="price" class="form-control">
                                          <span id="price-error" class="error"></span>
                                      </div>
                                      
                                      <div>
                                         <input type="hidden" id="productId" name="product_id">
                                      </div>
                                      
                              </div>

                          
                    </div>
                  
                  
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success" id="Bidding">Submit</button>
                  <button type="submit"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                
              </div>
            </form>
          </div>
      </div>
  </div>


    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>Bidding Site &copy; Interview , was done using Laravel, jquery, bootstrap 3 and 4 and Vue js!</p>
        <p>If you want to know more about me, <a href="www.munandi@gmail.com">Send me an email</a> or Visit my Linked In <a href="https://www.linkedin.com/wandumi-munandi-sichali" target="blank">to find more about my professional Career</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('admin/assets/js/vendor/jquery-slim.min.js') }}"><\/script>')</script> --}}
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/popper.min.js') }}"></script>
    <script src="{{ asset('front/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/holder.min.js') }}"></script>
    <script>
        $(document).ready(function(){


           $('.productButton').on('click', function(){

              $('#logQuery').modal('show');

              var productID = $(this).attr('data-productid');
              var productid = $('#productId').val(productID);

              // alert(productID);
              

              var product = 'products';

              $.ajax({
                  url: product+'/'+productID,
                  type:"GET",
                  dataType: "JSON",
                  success: function(data){
                     console.log(data);

                     var tableRow = '<tr>';
                     $.each(data, function(i, bids){
                        // tableRow += '<td>'+ i++ +'</td>';
                        tableRow += '<td>'+bids.email+'</td>';
                        tableRow += '<td>'+bids.price+'</td>';
                        tableRow += '</tr>';
                     });
                     
                     // add it to the page 
                     $('tbody').html(tableRow);

                     
                  },
                  error: function(){
                     alert('There was an error, Please try again later');
                  }
                  
              });
                
           });

           $('#Bidding').on('click', function(event){
              event.preventDefault();

              var formBidding = $('#BiddingForm').serialize();
              
              var productID = $('#productId').val();
              // alert(productID);

              

              $.ajax({
                 url: "{{ route('bids.store') }}",
                 type: "POST",
                 data: formBidding,
                 dataType: "JSON",
                 success: function(data){
                    console.log(data);

                    alert('Data Saved');

                    setTimeout(function(){
                      $('#logQuery').modal('show');
                      location.reload();
                    },2000);
                    
                 },
                 error: function(error){
                    $('#email-error').text(error.email);
                    $('#price-error').text(error.price);
                 }
              });
           });

        });
    </script>
  </body>
</html>
