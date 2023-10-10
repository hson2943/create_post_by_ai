<x-app-layout>
    <div class="container p-5 shadow">
        <h2 class="title">Cài đặt liên kết </h2>
        <hr>
        <div class="row justify-content-center ">
            <form action="/setting" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Link website của bạn</label>
                    <input name="link_website" type="text" class="form-control" value="{{$link_website}}">
                </div>
                <div id="link-sns-container">
                    @if(count($link_snses) == 0)
                    <div class='container_input mb-3'>
                        <label for="exampleInputPassword1" class="form-label">Link SNS của bạn</label>
                        <input name="link_sns[]" type="text" class="form-control" />
                    </div>
                    @endif
                    @foreach ($link_snses as $link_sns)
                    <div class='container_input mb-3'>
                        <label for="exampleInputPassword1" class="form-label">Link SNS của bạn</label>
                        <input name="link_sns[]" type="text" class="form-control" value="{{$link_sns->link_sns}}" />
                        <button type="button" data-sns-id="{{$link_sns->id}}" data-bs-toggle="modal"
                            data-bs-target="#modalDelete" class="btn btn-danger btn-delete">Xoá</button>
                    </div>
                    @endforeach
                </div>
                <button id="btn-add-sns" class="btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                <div class="d-flex flex-row-reverse py-2">
                    <button type="submit" class="btn btn-primary ">Lưu cài đặt</button>
                </div>
            </form>
        </div>
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
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- model delete --}}
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Xoá bài viết?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="content-modal-delete-post" class="modal-body">
                    Bạn có chắc muốn xoá sns này không ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a id="modal-btn-delete-post" type="button" class="btn btn-danger">Xoá</a>
                </div>
            </div>
        </div>
    </div>
    @if(session('status') != null)
    <script>
        const addButton = document.getElementById("addButton");
        const containerInput = document.getElementById("container_input");
        $(window).on('load', function() {
            $('#modalAlert').modal('show');
        });
        addButton.addEventListener("click", function () {
        // Get the value from the input field
        const newElement = document.createElement("input");

        // Append the new element to the container
        containerInput.appendChild(newElement);
    });
    </script>
    @endif

    <script>
        const elementSns = `<div class='container_input mb-3'>
                        <label for="exampleInputPassword1" class="form-label">Link SNS của bạn</label>
                        <input name="link_sns[]" type="text" class="form-control"/>
                    </div>`;
        $('#btn-add-sns').click(function(){
            $('#link-sns-container').append(elementSns);
        })

        $('#modalDelete').on('show.bs.modal', function(e) {
            var snsId = $(e.relatedTarget).data('sns-id');
            $('#modal-btn-delete-post').attr('href', `/sns/delete/${snsId}`);
        });
    </script>
</x-app-layout>

<style>
    .title {
        font-size: 2.25rem;
    }

    .container {
        background-color: white;
    }

    .container_input {
        position: relative;
    }

    .btn-delete {
        display: none;
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .container_input:hover>.btn-delete {
        display: block;
    }
</style>