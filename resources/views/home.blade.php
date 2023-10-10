<x-app-layout>
    <div class="container p-5 shadow">
        <div class="d-flex justify-content-between">

            <h2 class="title">Tạo bài viết </h2>
            <a class=" btn btn-primary px-3 d-flex align-items-center" id='copyBtn' href="\"><i class="fas
                fa-plus"></i></a>
        </div>
        <hr>

        <div class="row justify-content-center">
            <form action="/keyword/0" method="post" id="form-title">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
                    <input required id="maintitle" type="text" name="maintitle" class="form-control" id="maintitle">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Từ khóa</label>
                    <input required type="" name="mainkeyword" class="
                        form-control"
                        id="mainkeyword">
                </div>

            </form>
          
            <!-- Biến keywords tồn tại -->
            <div id="keyword_0_container" class="keyword_container keyword_0_container d-flex flex-wrap">

            </div>
            <div class=" d-flex flex-row py-2">
                <button type="button" id="newMainKeyWord_0" class="btn btn-primary" style="display: none;"><i
                        class="fas
                        fa-plus"></i></button>
            </div>
            {{-- 1 --}}
            <div class="mb-3" id='main_key_word_container_1' name='main_key_word_container_1' style="display: none;">
                <label for="exampleInputPassword1" class="form-label">Từ khóa 1</label>
                <input type="" name="mainkeyword_1" 
                    class="
                    form-control" id="mainkeyword_1">
            </div>
                <!-- Biến keywords tồn tại -->
                <div id="keyword_1_container" class="keyword_container keyword_1_container d-flex flex-wrap">
                </div>
                <div class=" d-flex flex-row py-2">
                    <button type="button" id="newMainKeyWord_1" class="btn btn-primary" style="display: none;"><i
                            class="fas
                            fa-plus"></i></button>
                </div>
            {{-- 2 --}}
            <div class="mb-3" id='main_key_word_container_2' name='main_key_word_container_2' style="display: none;">
                <label for="exampleInputPassword2" class="form-label">Từ khóa 2</label>
                <input type="" name="mainkeyword_2" 
                    class="
                    form-control" id="mainkeyword_2">
            </div>
                <!-- Biến keywords tồn tại -->
                <div id="keyword_2_container" class="keyword_container keyword_2_container d-flex flex-wrap">
                </div>
                <div class=" d-flex flex-row py-2">
                    <button type="button" id="newMainKeyWord_2" class="btn btn-primary" style="display: none;"><i
                            class="fas
                            fa-plus"></i></button>
                </div>
            {{-- 3 --}}
            <div class="mb-3" id='main_key_word_container_3' name='main_key_word_container_3' style="display: none;">
                <label for="exampleInputPassword3" class="form-label">Từ khóa 3</label>
                <input type="" name="mainkeyword_3" 
                    class="
                    form-control" id="mainkeyword_3">
            </div>
                <!-- Biến keywords tồn tại -->
                <div id="keyword_3_container" class="keyword_container keyword_3_container d-flex flex-wrap">
                </div>
                <div class=" d-flex flex-row py-2">
                    <button type="button" id="newMainKeyWord_3" class="btn btn-primary" style="display: none;"><i
                            class="fas
                            fa-plus"></i></button>
                </div>
            {{-- 4 --}}
            <div class="mb-3" id='main_key_word_container_4' name='main_key_word_container_4' style="display: none;">
                <label for="exampleInputPassword4" class="form-label">Từ khóa 4</label>
                <input type="" name="mainkeyword_4" 
                    class="
                    form-control" id="mainkeyword_4">
            </div>
                <!-- Biến keywords tồn tại -->
                <div id="keyword_4_container" class="keyword_container keyword_4_container d-flex flex-wrap">
                </div>
                <div class=" d-flex flex-row py-2">
                    <button type="button" id="newMainKeyWord_4" class="btn btn-primary" style="display: none;"><i
                            class="fas
                            fa-plus"></i></button>
                </div>
                <div id="loadingKeyword" style="display: none;">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            <div class=" d-flex flex-row-reverse py-2">
                <button id="createPostBtn" type="" id="createPostButton" class="btn btn-primary"
                    style="display: none;">Tạo bài viết</button>
            </div>

            <div id="loadingPost" style="display: none;">
                <i class="fas fa-spinner fa-spin"></i>
            </div>

            <div id='postForm' style="display: none;">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Nội dung bài viết tạo từ GPT</label>
                    <div class="textarea-container">
                        <textarea class="form-control textarea-container" readonly id="contentpost" rows="10"></textarea>
                        <button class="btn btn-primary copy-button" id='copyBtn'><i class="fas fa-plus"></i></button>
                    </div>

                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Chỉnh sửa nội dung
                    </label>
                    <textarea name="content" class="form-control" id="mainContentPost" rows="10"></textarea>
                </div>
                <div class=" d-flex flex-row-reverse py-2">
                    <button type="button" id="savePostBtn" class="btn btn-primary" style="display: none;">Lưu bài
                        viết</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script>
        var fd = new FormData();
        var inputTimer;
        var form = document.getElementById('form-title');
        var mainKeywordInput = document.getElementById('mainkeyword');
        var mainkeyword_1 = document.getElementById('mainkeyword_1');
        var mainkeyword_2 = document.getElementById('mainkeyword_2');
        var mainkeyword_3 = document.getElementById('mainkeyword_3');
        var mainkeyword_4 = document.getElementById('mainkeyword_4');
        var maintitleinput = document.getElementById('maintitle');
        var loadingKeywordElement = document.getElementById('loadingKeyword');
        var postFormElement = document.getElementById('postForm');
        var loadingPostElement = document.getElementById('loadingPost');
        var contentPost = document.getElementById('contentpost');
        var mainContentPost = document.getElementById('mainContentPost');
        var savePostBtn = document.getElementById('savePostBtn');
        var copyBtn = document.getElementById('copyBtn');
        var selectedKeywords = [];
        var listKeywords_0 = [];
        var newMainKeyWord_0 = $('#newMainKeyWord_0'); 
        var newMainKeyWord_1 = $('#newMainKeyWord_1');
        var newMainKeyWord_2 = $('#newMainKeyWord_2');
        var newMainKeyWord_3 = $('#newMainKeyWord_3');
        var newMainKeyWord_4 = $('#newMainKeyWord_4');
        var main_key_word_container_1 = document.getElementById('main_key_word_container_1');
        var main_key_word_container_2 = document.getElementById('main_key_word_container_2');
        var main_key_word_container_3 = document.getElementById('main_key_word_container_3');
        var main_key_word_container_4 = document.getElementById('main_key_word_container_4');
        // var maintitle = maintitleinput.value;
        document.addEventListener("DOMContentLoaded", function() {
            newMainKeyWord_0.click(function() {
                newMainKeyWord_0.css("display", "none");
                main_key_word_container_1.style.display = 'block';
            })
            newMainKeyWord_1.click(function() {
                newMainKeyWord_1.css("display", "none");
                main_key_word_container_2.style.display = 'block';
            })
            newMainKeyWord_2.click(function() {
                newMainKeyWord_2.css("display", "none");
                main_key_word_container_3.style.display = 'block';
            })
            newMainKeyWord_3.click(function() {
                newMainKeyWord_3.css("display", "none");
                main_key_word_container_4.style.display = 'block';
            })
        });
        mainKeywordInput.addEventListener('input', function() {
            clearTimeout(inputTimer);
            inputTimer = setTimeout(function() {
                var mainkeyword = mainKeywordInput.value;

                if (mainkeyword && maintitleinput.value) {
                    $.ajax({
                        url: 'keyword',
                        method: 'POST',
                        data: {
                            mainkeyword: mainKeywordInput.value,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log(data);
                            let list = document.getElementById("keyword_0_container");
                            for (i = 0; i < data.length; ++i) {
                                let btn = document.createElement('button');
                                btn.className = 'btn keyword m-1';
                                btn.style.backgroundColor = 'white';
                                btn.style.color = 'black';
                                btn.textContent = data[i];
                                list.appendChild(btn);
                            }
                            loadingKeywordElement.style.display='none';
                            newMainKeyWord_0.css('display', 'block');
                            $("#createPostBtn").css("display", "block");
                        },
                        error: function(xhr, status, error) {}
                    });
                    mainKeywordInput.value = mainkeyword;
                    mainKeywordInput.disabled = true;
                    maintitleinput.disabled = true;
                    mainKeywordInput.readOnly = true;
                    maintitleinput.readOnly = true;
                    loadingKeywordElement.style.display = 'block';
                }
            }, 3000);
        });
        // 1
        mainkeyword_1.addEventListener('input', function() {
            clearTimeout(inputTimer);
            inputTimer = setTimeout(function() {
                console.log(mainkeyword_1);
                var mainkeyword = mainkeyword_1.value;
                $.ajax({
                    url: 'keyword',
                    method: 'POST',
                    data: {
                        mainkeyword: mainkeyword_1.value,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                            let list = document.getElementById("keyword_1_container");
                            for (i = 0; i < data.length; ++i) {
                                let btn = document.createElement('button');
                                btn.className = 'btn keyword m-1';
                                btn.style.backgroundColor = 'white';
                                btn.style.color = 'black';
                                btn.textContent = data[i];
                                list.appendChild(btn);
                            }
                            loadingKeywordElement.style.display='none';
                            newMainKeyWord_1.css('display', 'block');
                    },
                    error: function(xhr, status, error) {}
                });
                mainkeyword_1.value = mainkeyword;
                mainkeyword_1.disabled = true;
                loadingKeywordElement.style.display = 'block';
            }, 3000);
        });
        // 2
        mainkeyword_2.addEventListener('input', function() {
            clearTimeout(inputTimer);
            inputTimer = setTimeout(function() {
                console.log(mainkeyword_2);
                var mainkeyword = mainkeyword_2.value;
                $.ajax({
                    url: 'keyword',
                    method: 'POST',
                    data: {
                        mainkeyword: mainkeyword_2.value,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                            let list = document.getElementById("keyword_2_container");
                            for (i = 0; i < data.length; ++i) {
                                let btn = document.createElement('button');
                                btn.className = 'btn keyword m-1';
                                btn.style.backgroundColor = 'white';
                                btn.style.color = 'black';
                                btn.textContent = data[i];
                                list.appendChild(btn);
                            }
                            loadingKeywordElement.style.display='none';
                            newMainKeyWord_2.css('display', 'block');
                    },
                    error: function(xhr, status, error) {}
                });
                mainkeyword_2.value = mainkeyword;
                mainkeyword_2.disabled = true;
                loadingKeywordElement.style.display = 'block';
            }, 3000);
        });
        // 3
        mainkeyword_3.addEventListener('input', function() {
            clearTimeout(inputTimer);
            inputTimer = setTimeout(function() {
                console.log(mainkeyword_3);
                var mainkeyword = mainkeyword_3.value;
                $.ajax({
                    url: 'keyword',
                    method: 'POST',
                    data: {
                        mainkeyword: mainkeyword_3.value,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                            let list = document.getElementById("keyword_3_container");
                            for (i = 0; i < data.length; ++i) {
                                let btn = document.createElement('button');
                                btn.className = 'btn keyword m-1';
                                btn.style.backgroundColor = 'white';
                                btn.style.color = 'black';
                                btn.textContent = data[i];
                                list.appendChild(btn);
                            }
                            loadingKeywordElement.style.display='none';
                            newMainKeyWord_3.css('display', 'block');
                    },
                    error: function(xhr, status, error) {}
                });
                mainkeyword_3.value = mainkeyword;
                mainkeyword_3.disabled = true;
                loadingKeywordElement.style.display = 'block';
            }, 3000);
        });
        //4
        mainkeyword_4.addEventListener('input', function() {
            clearTimeout(inputTimer);
            inputTimer = setTimeout(function() {
                console.log(mainkeyword_4);
                var mainkeyword = mainkeyword_4.value;
                $.ajax({
                    url: 'keyword',
                    method: 'POST',
                    data: {
                        mainkeyword: mainkeyword_4.value,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                            let list = document.getElementById("keyword_4_container");
                            for (i = 0; i < data.length; ++i) {
                                let btn = document.createElement('button');
                                btn.className = 'btn keyword m-1';
                                btn.style.backgroundColor = 'white';
                                btn.style.color = 'black';
                                btn.textContent = data[i];
                                list.appendChild(btn);
                            }
                            loadingKeywordElement.style.display='none';
                    },
                    error: function(xhr, status, error) {}
                });
                mainkeyword_4.value = mainkeyword;
                mainkeyword_4.disabled = true;
                loadingKeywordElement.style.display = 'block';
            }, 3000);
        });
        copyBtn.addEventListener('click', function() {
            mainContentPost.value = contentPost.value;
        });

        var keyword_container = document.getElementsByClassName('keyword_container');
        for (var i = 0; i < keyword_container.length; i++) {
            keyword_container[i].addEventListener('click', function(event) {
                if (event.target.classList.contains('btn')) {
                var clickedKeyword = event.target.textContent;
                selectedKeywords.push(clickedKeyword);
                console.log(selectedKeywords);
                event.target.style.backgroundColor = 'red';
                }
            });
        }


        // Sử dụng JavaScript để gắn sự kiện click cho nút button
        var createPostButton = document.getElementById('createPostBtn');

        savePostBtn.addEventListener('click', function() {

            $.ajax({
                url: '/posts',
                method: 'POST',
                data: {
                    keywords: selectedKeywords,
                    title: maintitleinput.value,
                    content: mainContentPost.value,
                    content_by_gpt: contentPost.value,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert('Tạo bài đăng thành công');
                    window.location = "/";
                },
                error: function(xhr, status, error) {
                    alert('Tạo bài đăng thất bại');
                }
            });
        });

        createPostButton.addEventListener('click', function() {
            var mainkeyword = mainKeywordInput.value;
            const elementContentPostGpt = document.querySelector('#contentpost');

            selectedKeywords.push(mainkeyword);
            savePostBtn.style.display = 'block';
            loadingPostElement.style.display = 'block';
            postFormElement.style.display = 'block';
            let url = ''
            for (let i = 0; i < selectedKeywords.length; i++) {
                url = `${url}&keywords[]=${selectedKeywords[i]}`
            }

            const eventSource = new EventSource(
                `/create-post-by-gpt?title=${encodeURIComponent(maintitleinput.value)}${url}`);
            eventSource.addEventListener("update", function(event) {
                if (event.data === "<END_STREAMING_SSE>") {
                    loadingPostElement.style.display = 'none';
                    eventSource.close();
                    return;
                }
                elementContentPostGpt.value += event.data;
            });
        });
    </script>

</x-app-layout>

<style>
    .textarea-container {
        position: relative;
    }

    .copy-button {
        padding: 0;
        position: absolute;
        top: 10px;
        right: 10px;
        height: 50px;
        width: 50px;
    }

    .title {
        font-size: 2.25rem;
    }

    .container {
        background-color: white;
    }
</style>
