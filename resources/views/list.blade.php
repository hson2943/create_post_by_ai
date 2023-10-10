<x-app-layout>
    <div class="container  p-5 shadow">
        <h2 class="title">Danh sách bài viết </h2>
        <hr>
        <div class="row justify-content-center ">
            <form class="mb-3" action="/history" method="GET">
                @csrf
                <div class="mb-3">
                    <button id="btn-search-conditions" class="btn-show-search mb-3" type="button">
                        Điều kiện tìm kiếm
                        <i id="icon-search-conditions" class="fas fa-chevron-down"></i>
                    </button>
                    <div id="search-conditions-wrapper">
                        <div id="search-conditions-content" class="search-conditions-content">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label font-bold">Tiêu đề</label>
                                <input id="title" value="{{request()->title ?? ''}}" name="title" type="text"
                                    class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label font-bold">Từ khóa</label>
                                <input id="keyword" value="{{request()->keyword ?? ''}}" name="keyword" type="text"
                                    class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label font-bold">Thời gian
                                </label>
                                <div class="d-flex gap-5">
                                    <input id="date-from" value="{{request()->date_from ?? ''}}" name="date_from" type="date"
                                        class="form-control" id="exampleInputPassword1" />
                                    <input id="date-to" value="{{request()->date_to ?? ''}}" name="date_to" type="date"
                                        class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                <button id="btn-reset" type="button" class="btn btn-primary">Đặt lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if(count($posts) != 0)
            <h4 style="text-align: center; font-weight: bold;">Có {{count($posts)}} bài viết</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%" scope="col">#</th>
                        <th width="20%" scope="col">Tiêu đề</th>
                        <th width="20%" scope="col">từ khóa</th>
                        <th width="20%" scope="col">Nội dung</th>
                        <th width="15%" scope="col">Thời gian</th>
                        <th width="20%" scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $index => $post)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>
                            <p class="line-clamp">{{$post['title']}}</p>
                        </td>
                        <td>
                            <p class="line-clamp">{{$post['keywords']->join(', ')}}</p>
                        </td>
                        <td>
                            <p class="line-clamp">{{$post['content']}}</p>
                        </td>
                        <td>{{$post['created_at']}}</td>
                        <td>
                            <a href="/posts/{{$post['id']}}" class="btn btn-sm btn-success"><i class="far fa-edit"></i></a>
                            <button data-post-id="{{$post['id']}}" data-post-title="{{$post['title']}}"
                                data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3>Không có bài viết nào</h3>
            @endif
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Xoá bài viết?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="content-modal-delete-post" class="modal-body">
                    Bạn có chắc muốn xoá bài viết này không ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a id="modal-btn-delete-post" type="button" class="btn btn-danger">Xoá</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#modalDelete').on('show.bs.modal', function(e) {
            var postId = $(e.relatedTarget).data('post-id');
            var postTitle = $(e.relatedTarget).data('post-title');
            $('#content-modal-delete-post').text(`Bạn có chắc xoá bài viết: ${postTitle}`);
            $('#modal-btn-delete-post').attr('href', `/posts/delete/${postId}`);
        });

        $('#btn-search-conditions').click(function(e){
            $("#search-conditions-wrapper").toggleClass('open');
            $("#icon-search-conditions").toggleClass('rotate');
        });

        $('#btn-reset').click(function(){
            $('#title').val('');
            $('#keyword').val('');
            $('#date-from').val(null);
            $('#date-to').val(null);
        });
    </script>
</x-app-layout>

<style scoped>
    .line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .title {
        font-size: 2.25rem;
    }
    .container{
        background-color: white;
    }

    .font-bold {
        font-weight: bold;
    }

    .btn-primary {
        width: 200px
    }

    #icon-search-conditions {
        transform: rotate(0deg);
        transition: transform 0.5s ease;
    }

    #icon-search-conditions.rotate {
        transform: rotate(180deg);
        transition: transform 0.5s ease;
    }

    #search-conditions-wrapper {
        display: grid;
        grid-template-rows: 0fr;
        transition: grid-template-rows 0.5s ease-out;
    }

    .search-conditions-content {
        overflow: hidden;
    }

    #search-conditions-wrapper.open {
        grid-template-rows: 1fr;
    }

    .btn-show-search {
        width: 100%;
        text-align: left;
        padding: 8px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #999;
        background-color: #fff;
        border-radius: 8px;
    }
</style>