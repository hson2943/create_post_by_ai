<x-app-layout>
    <div class="container">
        <h1>Chi tiết bài viết </h1>
        <hr>
        <div class="row justify-content-center">
            <form action="/posts/{{$post['id']}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
                    <input value="{{$post['title'] ?? ''}}" name="title" type="text" class="form-control"
                        id="exampleInputEmail1" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Từ khóa</label>
                    <input disabled value="{{$post['keywords']->join(', ')}}" name="'keyword" type="text"
                        class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 textarea-container">
                    <label for="exampleFormControlTextarea1" class="form-label">Nội dung bài viết tạo từ GPT</label>
                    <textarea disabled class="form-control textarea-container" id="exampleFormControlTextarea1"
                        rows="10">{{$post['content_by_gpt'] ?? ''}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Chỉnh sửa nội dung
                    </label>
                    <textarea rows="10" name="content" class="form-control"
                        id="exampleFormControlTextarea1">{{$post['content'] ?? ''}}</textarea>
                </div>
                <a href="{{route('history')}}" id="detail-btn-back" type="button" class="btn btn-primary">Quay lại</a>
                <button type="button" data-post-id="{{$post['id']}}" data-post-title="{{$post['title']}}"
                    data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger">Xoá</button>
                <button type="submit" class="btn btn-success">Lưu bài viết</button>
            </form>
        </div>
        {{-- Modal Delete--}}
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
        {{-- Modal Alert --}}
        {{-- Modal --}}
        <div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAlertLabel">Thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{session('status')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('status') != null)
    <script>
        $(window).on('load', function() {
            $('#modalAlert').modal('show');
        });
    </script>
    @endif
    <script>
        $('#modalDelete').on('show.bs.modal', function(e) {
            var postId = $(e.relatedTarget).data('post-id');
            var postTitle = $(e.relatedTarget).data('post-title');
            $('#content-modal-delete-post').text(`Bạn có chắc xoá bài viết: ${postTitle}`);
            $('#modal-btn-delete-post').attr('href', `/posts/delete/${postId}`);
        });
    </script>
</x-app-layout>