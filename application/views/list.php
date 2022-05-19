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

        @media screen and (max-width: 576px) {
            /* 모바일에 사용될 스트일 시트를 여기에 작성합니다. */
            body > div > div.body > div > div.col-xs-12.col-sm-9 > div > table > thead > tr > th:nth-child(1){
                width: 70% !important;
            }
            body > div > div.body > div > div.col-xs-12.col-sm-9 > div > table > thead > tr > th:nth-child(3){
                display: none !important;
            }
            body > div > div.body > div > div.col-xs-12.col-sm-9 > div > table > thead > tr > th:nth-child(4){
                display: none !important;
            }
            body > div > div.body > div > div.col-xs-12.col-sm-9 > div > table > tbody > tr td:nth-child(3){
                display: none !important;
            }
            body > div > div.body > div > div.col-xs-12.col-sm-9 > div > table > tbody > tr td:nth-child(4){
                display: none !important;
            }
        }
    </style>

    <div class="body">
       <div class="row">
            <div class="col-3 d-none d-sm-block">
                <!-- Hidden only on mobile -->
                <div class="list-group">
                    <a href="community" class="list-group-item list-group-item-action <? if($now_board == '1'){ echo "active"; } ?>">자유 커뮤니티</a>
                    <a href="notice" class="list-group-item list-group-item-action <? if($now_board == '2'){ echo "active"; } ?>">공지사항</a>
                    <a href="apply" class="list-group-item list-group-item-action <? if($now_board == '3'){ echo "active"; } ?>">신규 가입신청</a>
                    <a href="suggest" class="list-group-item list-group-item-action <? if($now_board == '4'){ echo "active"; } ?>">기능제안 및 오류제보</a>
                </div>
            </div>
            <div class="col-3 d-block d-sm-none">
                    <!-- Visible only on mobile -->

            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card" style="padding: 30px">
                    <p style="font-size: 24px; font-weight: 700; margin-bottom: 50px"><?=$page_title?></p>
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
                            <?
                                if(isset($itemsAll)){
                                    for($i=0;$i<count($itemsAll);$i++){
                                        echo "<tr>";
                                        echo "<td>";
                                        if($isNewArr[$i] == 1){
                                            echo "<span class='badge badge-danger'>N</span> ";
                                        }
                                        echo "<a href='/board/view/".$itemsAll[$i]->num."'>".$itemsAll[$i]->title."</a> <span class='badge badge-pill badge-primary'><i class='far fa-comment'></i> ".$commentsNumArr[$i]."</span></td>";
                                        echo "<td>".$itemsAll[$i]->writerName."</td>";
                                        echo "<td>".$itemsAll[$i]->writeTime."</td>";
                                        echo "<td>".$itemsAll[$i]->viewCount."</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <div>
                        <? if($boardShow != false){ ?>
                            <button type="button" class="btn btn-primary btn-sm" style="float:right" onclick="location.href='/board/write/<?=$category?>';"><i class="fas fa-pencil-alt"></i> 글쓰기</button>
                        <? } ?>
                    </div>
                </div>
            </div>
       </div> 
    </div>
</div>
</html>