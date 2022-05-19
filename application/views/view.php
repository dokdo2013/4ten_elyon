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
        .boardItemDetail{
            margin-bottom: 0;
        }
        .boardItemDetail span{
            margin-right: 10px;
            color: grey;
        }
        .boardItemDetail .name{
            font-size: 18px;
            font-weight: 700;
            color: black;
        }
        .commentItemDetail{
            margin-bottom: 25px;
            font-size: 14px;
        }
        .commentItemDetail span{
            margin-right: 10px;
            color: grey;
        }
        .commentItemDetail .name{
            font-size: 16px !important;
            font-weight: 700;
            color: black;
        }
        .comment{
            margin-bottom: 0;
        }
        .commentWrapper{
            background-color: rgba(0,0,0,0.05);
            border-radius: 0.25rem;
            min-height: 50px;
            margin: 10px 0;
            padding: 15px
        }

        @media screen and (max-width: 576px) {
            /* 모바일에 사용될 스트일 시트를 여기에 작성합니다. */
            body > div > div.body > div > div > div > p:nth-child(2){
                margin-top: 10px !important;
            }
            body > div > div.body > div > div > div > button{
                top: 20px !important;
                right: 20px !important;
            }
            body > div > div.body > div > div > div > div:nth-child(8) > div:nth-child(3) > form > input.form-control.form-inline{
                width: 100% !important;
            }

        }

    </style>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.js"></script>

    <div class="body">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 30px; margin-bottom: 20px">
                    <button class="btn btn-sm btn-outline-secondary" style="width:70px; position: absolute; top: 30px; right:30px" type="button" onclick="location.href='/board/list/<?=$category?>'"><i class="fas fa-list-alt"></i> 목록</button>
                    <p style="font-size:14px; font-weight: 400; color: grey; margin-bottom: 0"><?=$page_title?></p>
                    <p style="font-size:24px; font-weight: 700"><?=$itemDetail->title?></p>
                    <p class="boardItemDetail">
                        <span class="name"><?=$itemDetail->writerName?></span>
                        <span><?=$itemDetail->writeTime?></span>
                        <span><i class="fas fa-eye"></i> <?=$itemDetail->viewCount?>회</span>
                        <span><i class="fas fa-comment"></i> <?=$commentsNum?>개</span>
                    </p>
                    <hr>
                    <div style="margin: 20px 0">
                        <!-- Text 내용 -->
                        <?=$itemDetail->content?>
                    </div>
                    <hr>
                    <div>
                        <p>댓글 <span class="text-primary"><?=$commentsNum?></span></p>
                        <?
                            if($commentsNum == 0){?>
                                <div class="alert alert-secondary" style="text-align: center">
                                    등록된 댓글이 없습니다. 첫 번째 댓글을 달아보세요!
                                </div>
                       <?     }else{
                                for($i=0;$i<count($comments);$i++){
                                    echo "<div class=\"commentWrapper\">";
                                    echo "<p class=\"commentItemDetail\">";
                                    echo "<span class=\"name\">".$comments[$i]->writerName."</span>";
                                    echo "<span>".$comments[$i]->writeTime."</span>";
                                    echo "</p>";
                                    echo "<p class=\"comment\">".$comments[$i]->content."</p>";
                                    echo "</div>";
                                }
                            }
                        ?>
                        <!-- Write Comment -->
                        <div style="margin-top:40px">
                            <form action="/api/board/comWrite" method="POST">
                                <input type="hidden" name="targetItem" value="<?=$now_id?>">
                                <input class="form-control form-inline" type="text" style="width:300px" name="newCommentName" placeholder="이름 (10자 이내)" required>
                                <textarea id="summernote" class="form-control" name="newComment" placeholder="댓글을 입력해주세요" rows="3" required></textarea>
                                <div class="form-check form-check-inline" style="margin-top:20px">
                                    <input id="newCommentAgree" class="form-check-input" type="checkbox" name="newCommentAgree" value="true" required>
                                    <label for="newCommentAgree" class="form-check-label" style="margin-top:-13px">한 번 등록한 댓글은 수정 또는 삭제가 불가능합니다. 이에 동의합니다.</label>
                                </div>
                                <input class="btn btn-primary" style="float:right; margin-top: 10px" type="submit" value="등록">                            
                            </form>
                            <script>
                                $(document).ready(function(){
                                    $("#summernote").summernote({
                                        placeholder: "내용을 입력해주세요",
                                        tabsize: 2,
                                        height: 150,
                                        lang: 'ko-KR',
                                        toolbar: [
                                            ['Font Style', ['fontname']],
                                            ['style', ['bold', 'italic', 'underline']],
                                            ['font', ['strikethrough']],
                                            ['fontsize', ['fontsize']],
                                            ['color', ['color']],
                                            ['para', ['paragraph']],
                                            ['height', ['height']],
                                            ['Insert', ['picture']],
                                            ['Insert', ['link']],
                                            ['Misc', ['fullscreen']]
                                        ]
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</html>