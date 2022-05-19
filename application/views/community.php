    <style>
        .body{
            padding-top: 70px;
        }
        .card-stats-inner{
            line-height: 40px;
            text-align: center;
            font-size: 18px;
            padding-bottom: 5px;
        }
        input, select{
            margin-bottom: 10px;
        }
        
    </style>

    <div class="body">
       <div class="row">
            <div class="col-3 d-none d-sm-block">
                <!-- Hidden only on mobile -->
                <div class="list-group">
                    <a href="community" class="list-group-item list-group-item-action active">자유 커뮤니티</a>
                    <a href="notice" class="list-group-item list-group-item-action">공지사항</a>
                    <a href="apply" class="list-group-item list-group-item-action">신규 가입신청</a>
                    <a href="suggest" class="list-group-item list-group-item-action">기능제안 및 오류제보</a>
                </div>
            </div>
            <div class="col-3 d-block d-sm-none">
                    <!-- Visible only on mobile -->

            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card" style="padding: 30px">
                    <p style="font-size: 24px; font-weight: 700; margin-bottom: 50px">자유 커뮤니티</p>
                    <table class="table" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th style="width:55%">제목</th>
                                <th>글쓴이</th>
                                <th>작성일자</th>
                                <th>조회수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-danger">N</span> <a href="/board/view/1">게시판 테스트 작업 중입니다.</a></td>
                                <td>위공</td>
                                <td>20-12-19</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>게시판 테스트 작업 중입니다. 작업 중.</td>
                                <td>위즈공주님위즈공주님</td>
                                <td>20-12-19</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>게시판 테스트 작업 중입니다. <span class="badge badge-primary"><i class="fas fa-comment"></i> 3</span></td>
                                <td>위공</td>
                                <td>20-12-19</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" style="float:right" onclick="location.href='/board/write/community';"><i class="fas fa-pencil-alt"></i> 글쓰기</button>
                    </div>
                </div>
            </div>
       </div> 
    </div>
</div>
</html>