<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
	<body>
	<div class="container">
        <div class="m-5">
            <a href="{{ route('posts.index', ['page'=>$page]) }}">목록보기</a>
        </div>
		<div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" readonly class="form-control" id="title" name="title"
            value="{{ $post->title }}">
		</div>
		<div class="form-group">
		    <label for="content">Content</label>
		    <input class="form-control" id="content" name="content" readonly
            value="{{ $post->content }}">
		</div>
        <div class="form-group">
            <label>등록일</label>
            <input type="text" readonly class="form-control" value="{{ $post->created_at->diffForHumans() }}">
        </div>
        <div class="form-group">
            <label>수정일</label>
            <input type="text" readonly class="form-control" value="{{ $post->updated_at }}">
        </div>
        <div class="form-group">
            <label>작성자</label>
            <input type="text" readonly class="form-control" value="{{ $post->user_id }}">
        </div>
	</div>
</body>
</html>