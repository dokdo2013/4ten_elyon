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

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.js"></script>

    <div class="body">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding: 30px; margin-bottom: 20px">
                    <p style="font-size:24px; font-weight: 700; margin-bottom: 30px">글 작성 - <?=$page_title?></p>
                    <div class="alert alert-danger">
                        <strong>주의</strong>&nbsp;&nbsp;&nbsp; 한 번 등록한 글은 수정 또는 삭제가 불가하니 신중히 작성해주세요.
                    </div>
                    <form method="post" action="/api/board/write">
                        <input type="hidden" name="targetBoard" value="<?=$now_board?>">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="writerName" id="writerName" maxlength="10" placeholder="작성자 이름을 입력해주세요 (최대 10자)" required>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input type="password" class="form-control" name="writerPasswd" id="writerPasswd" minlength="4" maxlength="4" placeholder="비밀번호를 입력해주세요 (4자)" required>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="writeTitle" id="writeTitle" placeholder="제목을 입력해주세요" required>
                        <textarea id="summernote" name="editordata" required></textarea>
                        <div style="margin-top:20px">
                            <input class="btn btn-primary" type="submit" style="float: right" value="등록">
                            <input class="btn btn-outline-secondary" type="button" style="float: right; margin-right: 10px" onclick="history.back();" value="등록 취소">
                        </div>
                        <div style="clear: both"></div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            $("#summernote").summernote({
                                placeholder: "내용을 입력해주세요",
                                tabsize: 2,
                                height: 500,
                                lang: 'ko-KR',
                                toolbar: [
                                    ['Font Style', ['fontname']],
                                    ['style', ['bold', 'italic', 'underline']],
                                    ['font', ['strikethrough']],
                                    ['fontsize', ['fontsize']],
                                    ['color', ['color']],
                                    ['para', ['paragraph']],
                                    ['height', ['height']],
                                    ['Insert', ['picture', 'video']],
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
</html>