<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$page_title?> | 4TEN ELYON</title>

    <!-- jQuery & Bootstrap4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/datatables.min.js"></script>
 
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Shadow&family=Noto+Sans+KR:wght@100;300;400;500;700;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

    <!-- Growl -->
    <script src="/assets/jquery.growl/javascripts/jquery.growl.js"></script>
    <link rel="stylesheet" href="/assets/jquery.growl/stylesheets/jquery.growl.css">

    <!-- Custom CSS -->
    <!--<link rel="stylesheet" href="assets/style.css">-->
    <style>
        body{
            width: 100%;
            font-family: 'Noto Sans KR';
            background-color: rgba(243,199,217,0.15);
        }
        .wrapper{
            width: 100%;
            min-width: 300px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .header{
            height: 80px;
        }
        .title-wrapper{
            display: inline-block;
            line-height: 80px;
            float: left;
        }
        .header-auth{
            display: inline-block;
            line-height: 80px;
            float: right;
        }
        .header-nav{
            padding-top: 80px;
        }
        .title-wrapper span{
            font-family: 'Londrina Shadow', cursive;
            font-weight: 900;
            font-size: 34px;
        }
        .nav-tabs{
            width: 100%;
        }
        #headerTitle{
            color: black;
            text-decoration: none;
        }
        #headerTitle:hover{
            color: black;
            text-decoration: none;
        }
        .clearfix {*zoom:1;}
        @media screen and (max-width: 576px) {
            /* 모바일에 사용될 스트일 시트를 여기에 작성합니다. */
            body > div > div.header > div.header-nav > ul > li:nth-child(4){
                display: none;
            }body > div > div.header > div.header-nav > ul > li:nth-child(5){
                display: none;
            }body > div > div.header > div.header-nav > ul > li:nth-child(6){
                display: none;
            }
            .wrapper{
                padding: 0 10px 10px 10px;
            }
            body > div > div.body > div.row > div:nth-child(1){
                margin-bottom: 15px;
                height: auto !important;
            }
            body > div > div.body > div.row > div:nth-child(1) > div{
                overflow: hidden;
            }
            body > div > div.body > div.row > div:nth-child(1) > div > div:nth-child(3) > div > table{
                font-size: 14px;
            }
            #memberCard{
                margin-top: 15px !important;
            }
            .card-stats-inner{
                font-size: 16px !important;
                line-height: 30px !important;
            }
            #passwd{
                width: 170px !important;
            }
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="title-wrapper clearfix">
                <span><a href="/main" id="headerTitle">4TEN ELYON</a></span>
            </div>
            <div class="header-auth clearfix">
                <? if(!$_SESSION["is_login"]){ ?>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#loginModal"><i class="fas fa-user"></i> 관리자 로그인</button>
                <? }else{ ?>
                    <button type="button" class="btn btn-outline-primary" onclick="location.href='/auth/logout'"><i class="fas fa-sign-out-alt"></i> 로그아웃</button>
                <? } ?>
            </div>
            <div class="header-nav">
                <ul class="nav nav-tabs nav-justified">
                    <li class="nav-item">
                        <a class="nav-link <? if($now_dir == '1'){ echo "active"; } ?>" href="/main">메인</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <? if($now_dir == '2'){ echo "active"; } ?>" href="/board/list/community">커뮤니티</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <? if($now_dir == '3'){ echo "active"; } ?>" href="/board/list/notice">공지사항</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://bj.afreecatv.com/iouuru" target="_blank"><i class="fas fa-external-link-alt"></i> 포텐 방송국</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://elyon.game.daum.net/main" target="_blank"><i class="fas fa-external-link-alt"></i> 엘리온 홈페이지</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://elyon.inven.co.kr/" target="_blank"><i class="fas fa-external-link-alt"></i> 엘리온 인벤</a>
                    </li>
                </ul>
            </div>
            <!-- The Modal -->
            <div class="modal" id="loginModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">관리자 로그인</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>관리자 비밀번호를 입력해주세요.</p>
                            <form action="/auth/login" method="post" id="loginForm">
                                <label for="passwd">비밀번호</label>
                                <input type="password" name="passwd" id="passwd">
                            </form>
                            <p id="login_fail" style="color: red; display: none">비밀번호를 다시 확인해주세요.</p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('loginForm').submit();">로그인</button>
                        </div>

                    </div>
                </div>
            </div>              
        </div>
        <?
            if($login_fail){
                echo "<script>$(\"#loginModal\").modal();</script>";
                echo "<script>$(\"#login_fail\").show();</script>";
            }
        ?>

