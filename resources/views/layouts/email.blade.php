<!DOCTYPE html>
<html>
<head>
    <title></title>

<link href='https://fonts.googleapis.com/css?family=Anaheim' rel='stylesheet'>

    <style type="text/css">
        
    .content {

        
        background-color: #fff;
        padding:20px;



    }

    .content p {
        font-family: 'Anaheim';
        font-size:16px;
        
    }

    .container {
        padding:0px 100px 0px 100px;
        background-color: gray;
    }

    .footer {

        
        background-color: #F48359;
        color:#fff;
        text-align:center;
        padding:10px;
        font-weight: bold;



    }



    </style>
</head>
<body>

    <div class="container" style="margin:20px">

        <div class="" style="background-image: -moz-linear-gradient(0deg, #e66587 0%, #f09458 100%);
  background-image: -webkit-linear-gradient(0deg, #e66587 0%, #f09458 100%);
  background-image: -ms-linear-gradient(0deg, #e66587 0%, #f09458 100%); height:70px;
">

        <p style="padding:10px; color:#fff; font-weight: bold; font-size:20px; padding-top:20px;">CVMAMA</p>


        </div>      

        <div class="col-md-4 content" >
            
            @yield('content')
        </div>


         <div class="col-md-4 footer" >
            
            <p>CVMAMA CAREER SERVICES</p>
            
        </div>

    </div>

    

</body>
</html>