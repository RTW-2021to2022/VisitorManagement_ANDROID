<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--  부트스트랩 js 사용 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./resource/js/bootstrap.js"></script>
    <!-- 부트스트랩 css 사용 -->
    <link rel="stylesheet" href="./resource/css/bootstrap.css" />
    <link rel="stylesheet" href="./statistic.css" type="text/css" media="all" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="statistic.css">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="Chart.min.js"></script>
    <script src="https://kit.fontawesome.com/c881082b49.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript" src="./Chart.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- ====== Navbar start ======= -->
    <div class="pos-f-t">
      <div class="titlenav navbar navbar-expand-lg navbar-dark bg-dark">
        <h5 class="text-white h4" href="#">RTW corp. 방문자 관리 시스템</h5>
        <span class="text-muted"> IT로 세상을 바꾸는 RTW</span>
      </div>
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
        <h5 class="welcome"><?php echo "Hi, $ID";?> 관리자님 환영합니다!</h5>
          <a class="nav-item nav-link" href="home.php">HOME</a>
          <a class="nav-item nav-link" href="mainpage.php">방문자 조회</a>
          <a class="nav-item nav-link" href="statistic.php">방문자 통계</a>
          <a class="nav-item nav-link" href="camera.html">카메라</a>
          <button
            type="button"
            class="btn"
            onclick="location.href='Logout.php'"
          >
            LOGOUT
          </button>
        </div>
      </div>
      <nav class="navbar navbar-dark bg-dark">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarToggleExternalContent"
          aria-controls="navbarToggleExternalContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    </div>
    <!-- ====== Navbar end ======= -->
    <!--통계-->
    
   <!-- <div class="content"> -->
        <!-- <div class=statics>

        <canvas id="bar-chart" ></canvas>
        <script>
            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                labels: ["IT", "Marketing", "Europe", "Latin America"],
                datasets: [
                    {
                    label: "Visitor (명)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [2478,5267,734,784,433]
                    }
                ]
                },
                options: {
               
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
                }
            });
        </script>
        </div> -->
        <div class=statics>
    
    <canvas id="graphCanvas" style="height:30vh; width:50vw" ></canvas>
    
    <script>
            $(document).ready(function () {
            showGraph();
        });

        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                    var Place= [];
                    var Visitor = [];

                    for (var i in data) {
                        Place.push(data[i].Place);
                        Visitor.push(data[i].Visitor);
                    }

                    var chartdata = {
                        labels: Place,
                        datasets: [
                            {
                                label: 'Visitor',
                                backgroundColor: '#2F3545',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: Visitor
                            }
                        ]
                    };
                    var options = {
                                    scales : {
                                      yAxes : [ {
                                        ticks : {
                                          min: 0, // 0부터 시작하게 합니다.
                                          max:10   // 1 씩 증가하도록 설정합니다.
                                        }
                                      } ]
                                    }
                                  };
                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options:options
                    });
                });
            }
        }
    </script>

   <!-- </div> -->
<!--  부트스트랩 js 사용 -->
<script type="text/javascript" src="/resource/js/bootstrap.js"></script>

</body>
</html>