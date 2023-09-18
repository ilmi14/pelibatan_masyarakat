@extends('admin_dashboard.layouts.main')
@section('title')
    Detail Forum | Sibakat
@endsection

@section('content')
    @include('admin_dashboard.tutor.kelasku.includes.navbar')

    <div class="widget-content widget-content-area mb-3">
        <div class="widget-header">
            <div class="media">
                <div class="media-body d-flex justify-content-between">
                    <div>
                        <h4 class="media-heading">{{ $post->judul }}</h4>
                        <p class="media-text">Postingan oleh : {{ $post->user->nama . ' , ' . \Carbon\Carbon::parse($post->created_at)->format('j F Y H:i') }}</p>
                    </div>
                    <div>
                        @if ($post->user->id == Auth::user()->id)
                            <div class="dropdown d-inline-block">
                                <a class="dropdown-toggle" href="#" role="button" id="postAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                </a>

                                <div class="dropdown-menu left" aria-labelledby="postAction" style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                                    <a class="dropdown-item" href="#" onclick="editPostingan(); return false;">Edit Postingan</a>
                                    <a class="dropdown-item" href="#" onclick="hapusPostingan(); return false;">Hapus Postingan</a>
                                </div>
                            </div>
                        @else
                            <div class="dropdown d-inline-block">
                                <a class="dropdown-toggle" href="#" role="button" id="postAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                </a>

                                <div class="dropdown-menu left" aria-labelledby="postAction" style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                                    <a class="dropdown-item" href="#" onclick="hapusPostingan(); return false;">Hapus Postingan</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <hr style="margin-top: 5px; margin-bottom: 10px">
        </div>
        <div class="widget-content">
            <div id="showPost">
                {!! $post->isi !!}
            </div>
            <div id="editPost" style="display:none">
                <form action="{{ route('tutor.kelasku.forum.update', [$kelas->id, $post->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <textarea class="form-control" name="isi" id="post" rows="3">{!! $post->isi !!}</textarea>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Kirim</button>
                        <button class="btn btn-sm btn-secondary shadow-none" type="button" onclick="editPostingan()">Batalkan</button>
                    </div>
                </form>
            </div>
            <div class="mt-2">
                <span class="badge badge-info">{{ count($comment) }} komentar</span>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center row">
        <div class="col-md-12">
            <div class="d-flex flex-column comment-section">
                <div class="bg-white p-2">
                    @forelse ($comment as $comment)
                    <div id="comment{{ $comment->id }}">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-row user-info">
                                    @if($comment->user->foto != null)
                                        <img class="rounded-circle" src="{{ Storage::url($comment->user->foto) }}" width="40" height="40">
                                    @else
                                        <img class="rounded-circle" src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" alt="avatar" width="40" height="40">
                                    @endif
                                    <div class="d-flex flex-column justify-content-start ml-2">
                                        <span class="d-block font-weight-bold name">{{ $comment->user->nama }}</span>
                                        <span class="date text-black-50">{{ $comment->user->username . ' - ' . \Carbon\Carbon::parse($comment->created_at)->format('j F Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                @if ($comment->user->id == Auth::user()->id)
                                    <div class="dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="#" role="button" id="postAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
            
                                        <div class="dropdown-menu left" aria-labelledby="postAction" style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                                            <a class="dropdown-item" href="#" onclick="editKomentar({{ $comment->id }}); return false;">Edit Komentar</a>
                                            <a class="dropdown-item" href="#" onclick="hapusKomentar(this); return false;" data-comment="{{ $comment->id }}">Hapus Komentar</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="#" role="button" id="postAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
            
                                        <div class="dropdown-menu left" aria-labelledby="postAction" style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                                            <a class="dropdown-item" href="#" onclick="hapusKomentar(this); return false;" data-comment="{{ $comment->id }}">Hapus Komentar</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <div id="showComment{{ $comment->id }}">
                                {!! $comment->isi !!}
                            </div>
                            <div id="editComment{{ $comment->id }}" style="display:none">
                                <form action="{{ route('tutor.kelasku.forum.comment.update', [$kelas->id, $post->id, $comment->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method("put")
                                    <textarea class="form-control tinymce" name="isi" rows="3">{!! $comment->isi !!}</textarea>
                                    <div class="mt-2 text-right">
                                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Kirim</button>
                                        <button class="btn btn-sm btn-secondary shadow-none" type="button" onclick="editKomentar({{ $comment->id }})">Batalkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                    </div>
                    @empty
                        <div class="d-flex justify-content-center">
                            <div class="my-2">Jadilah orang yang pertama komentar</div>
                        </div>
                    @endforelse
                </div>
                <div class="bg-light p-2" id="comment">
                    <div class="d-flex align-items-center mb-3">
                        @if(Auth::user()->foto != null)
                            <img class="rounded-circle ml-1 mr-3" src="{{ Storage::url(Auth::user()->foto) }}" height="42" width="42">
                        @else
                            <img class="rounded-circle ml-1 mr-3" src="{{ asset('admin_dashboard/assets/img/90x90.jpg') }}" alt="avatar" width="42" height="42">
                        @endif
                        <strong>{{ Auth::user()->nama }}:</strong>
                    </div>
                    <form action="{{ route('tutor.kelasku.forum.comment.store', [$kelas->id, $post->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control shadow-none textarea tinymce" name="isi">{{ old('isi') }}</textarea>
                        </div>
                        <div class="mt-2 text-right">
                            <button class="btn btn-primary btn-sm shadow-none" type="submit">Beri Komentar</button>
                            <a href="{{ route('tutor.kelasku.forum.index', $kelas->id) }}" class="btn btn-sm btn-dark-light ml-1 shadow-none">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin_dashboard/assets/css/components/tabs-accordian/custom-tabs.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/assets/css/elements/alert.css') }}">
    <link href="{{ asset('admin_dashboard/assets/css/components/cards/card.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-media_object.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/comment/comment.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/lightbox/photoswipe.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/lightbox/default-skin/default-skin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/lightbox/custom-photswipe.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/elements/miscellaneous.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_dashboard/plugins/prismjs/prism.css') }}">
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <style>
        .btn-light { border-color: transparent; }
        </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/lightbox/photoswipe.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/lightbox/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/lightbox/custom-photswipe.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/editors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_dashboard/plugins/prismjs/prism.js') }}"></script>
    <script type='text/javascript'> 
        tinymce.init({
            selector: 'textarea.tinymce',
            // height: 150,
            plugins: 'link image codesample wordcount autoresize',
            menubar: false,
            toolbar: 'bold italic underline | link image codesample',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
    <script type='text/javascript'>
        tinymce.init({
            selector: 'textarea#post',
            // height: 500,
            plugins: 'fullscreen lists link image media codesample table wordcount autoresize',
            menubar: false,
            toolbar: 'fullscreen bold italic underline strikethrough subscript superscript | fontsize color | blocks alignment numlist bullist outdent indent blockquote | link image media codesample table | removeformat | undo redo',
            setup: (editor) => {
                editor.ui.registry.addGroupToolbarButton('alignment', {
                    icon: 'align-left',
                    tooltip: 'Alignment',
                    items: 'alignleft aligncenter alignright alignjustify'
                });
                editor.ui.registry.addGroupToolbarButton('color', {
                    icon: 'color-levels',
                    tooltip: 'Color',
                    items: 'forecolor backcolor'
                });
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
    <script>
        function editPostingan() {
            var showPost = document.getElementById("showPost");
            var editPost = document.getElementById("editPost");
            if (showPost.style.display === "none") {
                showPost.style.display = "block";
                editPost.style.display = "none";
            } else {
                showPost.style.display = "none";
                editPost.style.display = "block";
            }
        }
    </script>
    <script>
        function editKomentar(e) {
            var showComment = document.getElementById("showComment"+e);
            var editComment = document.getElementById("editComment"+e);
            var comment = document.getElementById("comment");

            if (showComment.style.display === "none") {
                showComment.style.display = "block";
                editComment.style.display = "none";
                comment.style.display = "block";
            } else {
                showComment.style.display = "none";
                editComment.style.display = "block";
                comment.style.display = "none";
            }
        }
    </script>
    <script>
        function hapusPostingan() {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak bisa mengembalikan ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, hapus',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type:'DELETE',
                        url:'{{route("tutor.kelasku.forum.destroy", [$kelas->id, $post->id])}}',
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(data) {
                            if (data.success){
                                Swal.fire(
                                    'Berhasil dihapus',
                                    'Data berhasil dihapus.',
                                    "success"
                                ).then(function(){
                                    window.location.href = "{{ route('tutor.kelasku.forum.index', $kelas->id)}}";
                                });
                            }
                        }
                    });
                }
            }) 
        }
    </script>
    <script>
        function hapusKomentar(e) {  
            let id = e.getAttribute('data-comment');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak bisa mengembalikan ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, hapus',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                // console.log(result);
                if (result.value) {
                    $.ajax({
                        type:'DELETE',
                        url:'{{url("/tutor/kelasku/$kelas->id/forum/$post->id/comment")}}/' +id,
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(data) {
                            if (data.success){
                                Swal.fire(
                                    'Berhasil dihapus',
                                    'Data berhasil dihapus.',
                                    "success"
                                );
                                $("#comment"+id+"").remove()
                            }
                        }
                    });
                }
            }) 
        }
    </script>
@endpush