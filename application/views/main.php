    <script>
        if (new Date() >= new Date('12/22/2020 00:00:00')            // 언제부터
            && new Date() < new Date('12/23/2020 18:00:00')) {        // 언제까지 실행하기 
                $.growl.notice({ title: "업데이트 공지", message: "<br>클랜 홈페이지에 게시판 기능이 신규 업데이트되었습니다! <a href='/board/view/8' style='color: purple'>공지 보기</a>", fixed: true });
        }
    </script>


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
            <div class="col-md-6 col-sm-12" style="height: 300px">
                <div class="card" style="height: 100%">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body card-stats-inner"><span style="font-weight: 700">총 클랜원수</span><br><?=$memberNumAll?></div>
                        </div>
                        <div class="col-6">
                            <div class="card-body card-stats-inner"><span style="font-weight: 700">가장 많은 직업군</span><br><?=$jobsBig?></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12" style="padding: 0 50px">
                            <p style="text-align: center; font-weight: 700; font-size: 18px">직업군별 클랜원 수</p>
                            <table class="table table-light" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>엘리멘탈리스트</th>
                                        <th>미스틱</th>
                                        <th>워로드</th>
                                        <th>어쌔신</th>
                                        <th>거너</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$memberNumJob[0]?></td>
                                        <td><?=$memberNumJob[1]?></td>
                                        <td><?=$memberNumJob[2]?></td>
                                        <td><?=$memberNumJob[3]?></td>
                                        <td><?=$memberNumJob[4]?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12" style="height: 300px;">
                <div class="card" style="height: 100%; padding: 10px">
                    <canvas id="statChart" style="width: 100%; height: 100%"></canvas>
                    <script>
                        var ctx = document.getElementById('statChart');
                        var myChart = new Chart(ctx, {
                            type: 'horizontalBar',
                            data: {
                                labels: ['엘리멘탈리스트', '미스틱', '워로드', '어쌔신', '거너'],
                                datasets: [{
                                    data: [<?=$memberNumJob[0]?>, <?=$memberNumJob[1]?>, <?=$memberNumJob[2]?>, <?=$memberNumJob[3]?>, <?=$memberNumJob[4]?>, ],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.yLabel;
                                        }
                                    }
                                },
                                title: {
                                    display: true,
                                    text: '직업군별 클랜원 수',
                                    fontSize: 18,
                                    fontColor: 'black'
                                },
                                scales: {
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        
        <div class="card" id="memberCard" style="margin-top: 25px; padding: 30px; position: relative; margin-bottom: 25px">
            <p style="font-size: 18px; font-weight: 700; margin-bottom: 30px">클랜원 명단</p>
            <? if($_SESSION["is_login"]){ ?>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal" style="position: absolute; top: 30px; right: 30px;"><i class="fas fa-user-plus"></i> 클랜원 추가</button>
            <? } ?>
            <table id="memberTable" class="table table-bordered" <? if($_SESSION["is_login"]){ ?> style="width:100% !important" <?}?>>
                <thead>
                    <tr>
                        <th>순번</th>
                        <th>직책</th>
                        <th>계정</th>
                        <th>닉네임</th>
                        <th>직업</th>
                        <th>아이템 레벨</th>
                        <th>비고</th>
                        <? if($_SESSION["is_login"]){ ?>
                            <th style="width: 40px">수정</th>
                            <th style="width: 40px">삭제</th>
                        <? } ?>
                    </tr>
                </thead>
            </table>
            <?
                if($_SESSION["is_login"]){
                    $dodo = 1;
                }else{
                    $dodo = 0;
                }
            ?>
            <script>
                var tempJson = '<?=$memberJson?>';
                parsedJson = JSON.parse(tempJson);
                parsedStringJson = JSON.stringify(parsedJson);
                parsedStringParsedJson = JSON.parse(parsedStringJson);
                var dodo = '<?=$dodo?>';
                if(dodo == '1'){
                    $(document).ready(function(){
                        var table = $("#memberTable").DataTable({
                            "scrollX": true,
                            "paging": false,
                            "data": parsedStringParsedJson,
                            "columns": [
                                { "data": "cnt" },
                                { "data": "userLevel" },
                                { "data": "userNickname" },
                                { "data": "userAccountName" },
                                { "data": "job" },
                                { "data": "itemLevel" },
                                { "data": "etc1" },
                                { "data": "num" },
                                { "data": "num" }
                            ],
                            "columnDefs": [
                                {
                                    "targets": -2,
                                    "data": null,
                                    "render": function(data, type, row){
                                        return '<button type="button" class="editBtn btn btn-sm btn-outline-secondary">수정</button>';
                                    },
                                    "orderable": false
                                },
                                {
                                    "targets": -1,
                                    "data": null,
                                    "render": function(data, type, row){
                                        return '<button type="button" class="delBtn btn btn-sm btn-outline-danger">삭제</button>';
                                    },
                                    "orderable": false
                                }
                            ],
                            "language": {
                                "emptyTable": "데이터가 없어요.",
                                "lengthMenu": "페이지당 _MENU_ 개씩 보기",
                                "info": "현재 _START_ - _END_ / _TOTAL_건",
                                "infoEmpty": "데이터 없음",
                                "infoFiltered": "( _MAX_건의 데이터에서 필터링됨 )",
                                "search": "검색: ",
                                "zeroRecords": "일치하는 데이터가 없어요.",
                                "loadingRecords": "로딩중...",
                                "processing":     "잠시만 기다려 주세요...",
                                "paginate": {
                                    "next": "다음",
                                    "previous": "이전"
                                }
                            },
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: '4TEN ELYON'
                                }
                            ]
                        });

                        $('.editBtn').click( function () {
                            var data = table.row( $(this).parents('tr') ).data();
                            var num = data["num"];
                            var userLevel = data["userLevelNum"];
                            var userNickname = data["userNickname"];
                            var userAccountName = data["userAccountName"];
                            var job = data["jobNum"];
                            var itemLevel = data["itemLevel"];
                            var etc1 = data["etc1"];

                            $("#usLevel2").val(userLevel);
                            $("#usNickname2").val(userNickname);
                            $("#usAccountName2").val(userAccountName);
                            $("#usJob2").val(job);
                            $("#usItemLevel2").val(itemLevel);
                            $("#usEtc2").val(etc1);
                            $("#targetId2").val(num);
                            $("#editModal").modal();
                        } );
                        $('.delBtn').click( function () {
                            var data = table.row( $(this).parents('tr') ).data();
                            var number = data["num"];
                            if(confirm("정말 삭제하시겠습니까?")){
                                $.ajax({
                                    cache: false,
                                    url: "/api/member/delete",
                                    type: 'POST',
                                    data: {
                                        'id' : number
                                    },
                                    success: function(data){
                                        console.log(data);
                                        if(data == "success"){
                                            // 삭제 성공
                                            $.growl.notice({ title: "성공", message: "클랜원을 성공적으로 삭제하였습니다." });
                                            location.reload();
                                        }else if(data == "fail"){
                                            // 삭제 실패
                                            $.growl.error({ title: "실패", message: "클랜원 삭제에 실패하였습니다. 관리자 문의 바랍니다." });
                                        }
                                    },
                                    error: function(data){
                                        $.growl.error({ title: "실패", message: "클랜원 삭제에 실패하였습니다. 관리자 문의 바랍니다." });
                                    }
                                });
                            }else{
                                return;
                            }
                        } );
                    });
                }else{
                    $(document).ready(function(){
                        $("#memberTable").DataTable({
                            "responsive": true,
                            "data": parsedStringParsedJson,
                            "columns": [
                                { "data": "cnt" },
                                { "data": "userLevel" },
                                { "data": "userNickname" },
                                { "data": "userAccountName" },
                                { "data": "job" },
                                { "data": "itemLevel" },
                                { "data": "etc1" },
                            ],
                            "language": {
                                "emptyTable": "데이터가 없어요.",
                                "lengthMenu": "페이지당 _MENU_ 개씩 보기",
                                "info": "현재 _START_ - _END_ / _TOTAL_건",
                                "infoEmpty": "데이터 없음",
                                "infoFiltered": "( _MAX_건의 데이터에서 필터링됨 )",
                                "search": "검색: ",
                                "zeroRecords": "일치하는 데이터가 없어요.",
                                "loadingRecords": "로딩중...",
                                "processing":     "잠시만 기다려 주세요...",
                                "paginate": {
                                    "next": "다음",
                                    "previous": "이전"
                                }
                            }
                        });
                    });
                    
                }
            </script>
        </div>
    </div>

    <? if($_SESSION["is_login"]){ ?>
    <!-- ADD MODAL -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">클랜원 추가</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/api/member/add" method="post" id="addForm">
                        <label for="userLevel">직책</label>
                        <select class="form-control" name="userLevel" id="usLevel">
                            <option value="5">클랜원</option>
                            <option value="9">부마스터</option>
                        </select>
                        <label for="userNickname">계정명 (게임)</label>
                        <input class="form-control" type="text" name="userNickname" id="usNickname">
                        <label for="userAccountName">닉네임 (디스코드)</label>
                        <input class="form-control" type="text" name="userAccountName" id="usAccountName">
                        <label for="userJob">직업</label>
                        <select class="form-control" name="userJob" id="usJob">
                            <option value="1">엘리멘탈리스트</option>
                            <option value="2">미스틱</option>
                            <option value="3">워로드</option>
                            <option value="4">어쌔신</option>
                            <option value="5">거너</option>
                        </select>
                        <label for="userItemLevel">아이템 레벨</label>
                        <input class="form-control" type="text" name="userItemLevel" id="usItemLevel">
                        <label for="userEtc">비고</label>
                        <input class="form-control" type="text" name="userEtc" id="usEtc">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('addForm').submit();">추가</button>
                </div>

            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">클랜원 수정</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/api/member/edit" method="post" id="editForm">
                        <label for="userLevel">직책</label>
                        <select class="form-control" name="userLevel" id="usLevel2">
                            <option value="5">클랜원</option>
                            <option value="9">부마스터</option>
                            <option value="10">마스터</option>
                        </select>
                        <label for="userNickname">계정명 (게임)</label>
                        <input class="form-control" type="text" name="userNickname" id="usNickname2">
                        <label for="userAccountName">닉네임 (디스코드)</label>
                        <input class="form-control" type="text" name="userAccountName" id="usAccountName2">
                        <label for="userJob">직업</label>
                        <select class="form-control" name="userJob" id="usJob2">
                            <option value="1">엘리멘탈리스트</option>
                            <option value="2">미스틱</option>
                            <option value="3">워로드</option>
                            <option value="4">어쌔신</option>
                            <option value="5">거너</option>
                        </select>
                        <label for="userItemLevel">아이템 레벨</label>
                        <input class="form-control" type="text" name="userItemLevel" id="usItemLevel2">
                        <label for="userEtc">비고</label>
                        <input class="form-control" type="text" name="userEtc" id="usEtc2">
                        <input type="hidden" name="targetId2" id="targetId2">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('editForm').submit();">수정</button>
                </div>

            </div>
        </div>
    </div>

    <!-- VIEW MODAL -->
    <div class="modal" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">클랜원 상세</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/api/member/view" method="post" id="viewForm">
                        <label for="passwd">비밀번호</label>
                        <input type="password" name="passwd" id="passwd">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
                </div>

            </div>
        </div>
    </div>
    <? } ?>


    </div>
</body>
</html>